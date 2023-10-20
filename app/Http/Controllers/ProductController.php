<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // direct to create page
    public function createPage() {
        $categories = Category::get();
        $subCategories = SubCategory::get();
        return view('admin.products.createPage',compact('categories','subCategories'));
    }

    // create product
    public function create (Request $request ) {
        $this->validateProduct($request);
        $data = $this->convertProductDataToArray($request);

        if($request->file('image')) {
            if(!(url()->previous() === route('admin#product#createPage'))) {
                if($request->image !== null) {
                    $oldImageName = Product::where('id',$request->id)->first();
                    $oldImageName = $oldImageName->image;
                    Storage::delete('public/admin/product/'.$oldImageName);
                }
            }

            $imageName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/admin/product',$imageName);
            $data['image'] = $imageName;
        }

        if(url()->previous() === route('admin#product#createPage')) {
            Product::create($data);
            return redirect()->route('admin#product#list')->with(['createdProduct' => 'New Product is created']);
        }

        Product::where('id',$request->id)->update($data);
        return redirect()->route('admin#product#list')->with(['updatedProduct' => 'Product is updated']);
    }

     // list
     public function list (Request $request) {
        if ($request->sortByCategory !== 'all' ) {
            $products = Product::select('products.*','categories.name as category_name','sub_categories.name as sub_category_name')->when(request('searchProduct'),function ($query){
                $query->where('products.name', 'like', '%' . request('searchProduct') . '%');
            })->when(request('sortByCategory'),function ($query){
                $query->where('products.category_id', request('sortByCategory'));
            })
            ->leftJoin('categories','products.category_id','categories.id')
            ->leftJoin('sub_categories','products.sub_category_id','sub_categories.id')
            ->orderBy('products.created_at','desc')->paginate(5);
            $products->append(request()->all());
        } else {
            $products = Product::select('products.*','categories.name as category_name','sub_categories.name as sub_category_name')->when(request('searchProduct'),function ($query){
                $query->where('products.name', 'like', '%' . request('searchProduct') . '%');
            })
            ->leftJoin('categories','products.category_id','categories.id')
            ->leftJoin('sub_categories','products.sub_category_id','sub_categories.id')
            ->orderBy('products.created_at','desc')->paginate(5);
            $products->append(request()->all());
        }
        $categories = Category::get();

        return view('admin.products.list',compact('products','categories'));
    }

      // update
    public function update ($id) {
        $product = Product::where('id',$id)->get()->first();
        $categories = Category::get();
        $subCategories = SubCategory::get();
        return view('admin.products.update',compact('product','categories','subCategories'));
    }

    // featured
    public function featuredProduct ($id) {
        $product = Product::where('id',$id)->get()->first();
        if($product->featured === 0) {
            $data = [
                'featured' => 1
            ];
        }
        if($product->featured === 1) {
            $data = [
                'featured' => 0
            ];
        }


        Product::where('id',$id)->update($data);

        if($product->featured === 1) {
            return redirect()->route('admin#product#list')->with(['featured' => 'Product has been Un-featured']);
        }
        if($product->featured === 0) {
            return redirect()->route('admin#product#list')->with(['featured' => 'Product has been Featured']);
        }

    }

    // delete
    public function delete($id) {
        $oldImageName = Product::where('id',$id)->first();
        if($oldImageName->image !== null) {
            $oldImageName = $oldImageName->image;
            Storage::delete('public/admin/product/'.$oldImageName);
        }
        Product::where('id',$id)->delete();

        return redirect()->route('admin#product#list')->with(['deletedProduct' => 'Product has been deleted']);
    }

     // validate product
     private function validateProduct($request) {
        Validator::make($request->all(),[
            'name' => 'required|unique:products,name,'.$request->id,
            'image' => 'image|file|max:800|required_if:name,null',
            'description' => 'required',
            'categoryId' => 'required',
            'subCategoryId' => 'required',
            'price' => 'required',
            'year' => 'required',
            'sorting_word' => 'required'
        ])->validate();
    }

    // convert array data
    private function convertProductDataToArray ($request) {
        return [
         'name' => $request->name,
         'description' => $request->description,
         'category_id' => $request->categoryId,
         'sub_category_id' => $request->subCategoryId,
         'price' => $request->price,
         'year' => $request->year,
         'sorting_word' => $request->sorting_word
        ];
    }
}
