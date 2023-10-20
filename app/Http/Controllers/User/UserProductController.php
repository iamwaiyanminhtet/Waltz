<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    // direct product page
    public function displayProduct ($productId) {
        $product = Product::select('products.*','categories.name as category_name','categories.id as category_id','sub_categories.name as sub_category_name','sub_categories.id as sub_category_id')->where('products.id',$productId)
        ->leftJoin('sub_categories','products.sub_category_id','sub_categories.id')
        ->leftJoin('categories','products.category_id','categories.id')->get()->first();

        $relatedProducts = Product::where('products.sub_category_id',$product->sub_category_id)->where('id','!=',$productId)->take(4)->get();
        // dd($relatedProducts);
        return view('user.product.product', compact('product','relatedProducts'));
    }

    // direct all product page
    public function allProducts (Request $request) {
        $products = Product::when(request('allProductsSearchKey'),function ($query){
            $query->where('name', 'like', '%' . request('allProductsSearchKey') . '%');
        })->paginate(8);
        $products->append(request()->all());
        $categories = Category::get();
        $subcategories = SubCategory::get();
        return view('user.product.allProducts',compact('products','categories','subcategories'));
    }
}
