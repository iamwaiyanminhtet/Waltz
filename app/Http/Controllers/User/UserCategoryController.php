<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCategoryController extends Controller
{
  // direct sub categories
  public function subcategories ($id) {
    $category = Category::where('id',$id)->get()->first();
    $subcategories = SubCategory::where('category_id',$id)->get()->all();
    $sorting_words = SubCategory::where('category_id',$id)->distinct()->pluck('sorting_word')->all();
    return view('user.category.subcategories',compact('subcategories','category','sorting_words'));
  }

  // products by sub category
  public function productBySubcategory ($id) {
    $categoryAndSubcategoryName = SubCategory::select('sub_categories.name as subcategory_name','sub_categories.id as subcategory_id','categories.name as category_name','categories.id as category_id')
    ->where('sub_categories.id',$id)->leftJoin('categories','sub_categories.category_id','categories.id')->get()->first();
    $products = Product::where('sub_category_id',$id)->get()->all();
    $sorting_words = Product::where('sub_category_id',$id)->distinct()->pluck('year')->all();
    return view('user.category.productBySubcategory',compact('products','categoryAndSubcategoryName','sorting_words'));
  }

  // subcategory sorting ajax
  public function subcategorySortingAjax (Request $request) {
    if($request->sorting_word === "all") {
        $sortedSubcategories = SubCategory::where('category_id',$request->categoryId)->get()->all();
    }else {
        $sortedSubcategories = SubCategory::where('sorting_word',$request->sorting_word)->where('category_id',$request->categoryId)->get()->all();
    }

    return response()->json($sortedSubcategories);
  }

  // subcategory products sorting ajax
  public function subcategoryProductsSortingAjax (Request $request) {
    if($request->year === "all") {
        $products = Product::where('sub_category_id',$request->sub_category_id)->get()->all();
    }else {
        $products = Product::
        where('sub_category_id',$request->sub_category_id)
        ->where('year',$request->year)
        ->get()->all();
    }

    return response()->json($products);
  }

  // retrieve category to Navbar
  public function retrieveCategoryToNavbar () {
    $category = Category::all();
    return response()->json($category);
  }

}

