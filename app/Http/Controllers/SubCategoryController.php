<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
     // sub category create
     public function createSubCategory(Request $request) {
        $this->validateSubCategory($request);
        $data = $this->convertSubCategoryDataToArray($request);

        if($request->file('subCategoryImage')) {
            if(url()->previous() !== route('admin#category#createPage')) {
                if($request->subCategoryImage) {
                    $oldImageName = SubCategory::where('id',$request->id)->first();
                    $oldImageName = $oldImageName->image;
                    Storage::delete('public/admin/subcategory/'.$oldImageName);
                }
            }

            $imageName = uniqid().$request->file('subCategoryImage')->getClientOriginalName();
            $request->file('subCategoryImage')->storeAs('public/admin/subcategory',$imageName);
            $data['image'] = $imageName;
        }

        if(url()->previous() === route('admin#category#createPage')) {
            SubCategory::create($data);
            return redirect()->route('admin#category#subCategoryList')->with(['createdSubCategory' => 'New Sub Category has been created']);
        }

        SubCategory::where('id',$request->id)->update($data);
        return redirect()->route('admin#category#subCategoryList')->with(['updatedSubCategory' => 'Sub Category has been updated']);
    }

    // direct list page
    public function subCategoryList (Request $request) {
        if ($request->sortByCategory !== 'all') {
            $subCategories = SubCategory::select('sub_categories.*','categories.name as category_name')
            ->when(request('searchSubCategory'),function ($query){
                        $query->where('sub_categories.name', 'like', '%' . request('searchSubCategory') . '%');})
                    ->when(request('sortByCategory'),function($query) {
                        $query->where('sub_categories.category_id',request('sortByCategory'));})
            ->leftJoin('categories','sub_categories.category_id','categories.id')
            ->orderBy('sub_categories.created_at','desc')->paginate(3);
            $subCategories->append(request()->all());
        }else {
            $subCategories = SubCategory::select('sub_categories.*','categories.name as category_name')
            ->when(request('searchSubCategory'),function ($query){
                        $query->where('sub_categories.name', 'like', '%' . request('searchSubCategory') . '%');})
            ->leftJoin('categories','sub_categories.category_id','categories.id')
            ->orderBy('sub_categories.created_at','desc')->paginate(3);
            $subCategories->append(request()->all());
        }
        $categories = Category::get();
        return view('admin.category.subCategoryList',compact('subCategories','categories'));
    }

    // update page
    public function update ($id) {
        $subCategory = SubCategory::where('id',$id)->get()->first();
        $categories = Category::get();
        return view('admin.category.updateSubCategory',compact('subCategory','categories'));
    }

    // delete
    public function delete($id) {
        $oldImageName = SubCategory::where('id',$id)->first();
        if($oldImageName->image !== null) {
            $oldImageName = $oldImageName->image;
            Storage::delete('public/admin/subcategory/'.$oldImageName);
        }
        SubCategory::where('id',$id)->delete();

        return redirect()->route('admin#category#subCategoryList')->with(['deletedSubCategory' => 'Sub Category has been deleted']);
    }

    // validate sub category
    private function validateSubCategory($request) {
        Validator::make($request->all(),[
            'subCategoryName' => 'required',
            'categoryId' => 'required',
            'subCategoryImage' => 'image|file|max:800|required_if:subCategoryName,null'
        ])->validate();
    }

    // convert array data
    private function convertSubCategoryDataToArray ($request) {
        return [
         'name' => $request->subCategoryName,
         'category_id' => $request->categoryId,
         'sorting_word' => $request->subCategorySortingWord
        ];
    }
}
