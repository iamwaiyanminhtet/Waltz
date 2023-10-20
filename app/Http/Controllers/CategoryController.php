<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct to create page
    public function create() {
        $categories = Category::get();
        $subCategories = SubCategory::get();
        return view('admin.category.createPage',compact('categories','subCategories'));
    }

    // create category
    public function createCategory(Request $request) {
        $this->validateCategory($request);
        $data = $this->convertCategoryDataToArray($request);

        if($request->file('categoryImage')) {
            if(!(url()->previous() === route('admin#category#createPage'))) {
                if($request->categoryImage !== null) {
                    $oldImageName = Category::where('id',$request->id)->first();
                    $oldImageName = $oldImageName->image;
                    Storage::delete('public/admin/category/'.$oldImageName);
                }
            }

            $imageName = uniqid().$request->file('categoryImage')->getClientOriginalName();
            $request->file('categoryImage')->storeAs('public/admin/category',$imageName);
            $data['image'] = $imageName;
        }
        if(url()->previous() === route('admin#category#createPage')) {
            Category::create($data);
            return redirect()->route('admin#category#categoryList')->with(['createdCategory' => 'New Category has been created']);
        }
        Category::where('id',$request->id)->update($data);
        return redirect()->route('admin#category#categoryList')->with(['updatedCategory' => 'New Category has been updated']);
    }

    // list
    public function categoryList () {
        $categories = Category::when(request('searchCategory'),function ($query){
            $query->where('name', 'like', '%' . request('searchCategory') . '%');
        })
        ->orderBy('created_at','desc')->paginate(5);
        $categories->append(request()->all());
        return view('admin.category.categoryList',compact('categories'));
    }

    // update
    public function update ($id) {
        $category = Category::where('id',$id)->get()->first();
        return view('admin.category.updateCategory',compact('category'));
    }

    // delete
    public function delete($id) {
        $oldImageName = Category::where('id',$id)->first();
        if($oldImageName->image !== null) {
            $oldImageName = $oldImageName->image;
            Storage::delete('public/admin/category/'.$oldImageName);
        }
        Category::where('id',$id)->delete();

        return redirect()->route('admin#category#categoryList')->with(['deletedCategory' => 'Category has been deleted']);
    }

    // validate category
    private function validateCategory($request) {
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name,'.$request->id,
            'categoryImage' => 'image|file|max:800|required_if:categoryName,null'
        ])->validate();
    }

    // convert array data
    private function convertCategoryDataToArray ($request) {
        return [
         'name' => $request->categoryName,
        ];
    }


}
