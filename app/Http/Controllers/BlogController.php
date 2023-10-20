<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    // create page
    public function createPage () {
        $categories = Category::all();
        $admins = User::where('role','admin')->get()->all();
        return view('admin.blog.createPage',compact('categories','admins'));
    }

    // create new blog
    public function create (Request $request) {
        $this->validateBlog($request);
        $data = $this->convertBlogDataToArray($request);

        if($request->file('image')) {
            if(!(url()->previous() === route('admin#blog#createPage'))) {
                if($request->image !== null) {
                    $oldImageName = Blog::where('id',$request->id)->first();
                    $oldImageName = $oldImageName->image;
                    Storage::delete('public/admin/product/'.$oldImageName);
                }
            }

            $imageName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/admin/blog',$imageName);
            $data['image'] = $imageName;
        }

        if(url()->previous() === route('admin#blog#createPage')) {
            Blog::create($data);
            return redirect()->route('admin#blog#list')->with('createdBlog','New Blog has been created');
        }
        Blog::where('id',$request->id)->update($data);
        return redirect()->route('admin#blog#list')->with('updatedBlog',' Blog has been updated');
    }

    // list
    public function list (Request $request) {
        $blogs = Blog::select('blogs.*','users.name as admin_name')->when(request('searchBlog'),function ($query){
            $query->where('blogs.title', 'like', '%' . request('searchBlog') . '%');
            $query->orWhere('blogs.description', 'like', '%' . request('searchBlog') . '%');
        })->when(request('sortByCategory'),function ($query){
            if(request('sortByCategory') === 'all') {
                return;
            }
            $query->where('blogs.category_id', request('sortByCategory'));
        })->leftJoin('users','blogs.admin_id','users.id')
        ->paginate(10);
        $blogs->append(request()->all());
        $categories = Category::all();
        return view('admin.blog.list',compact('blogs','categories'));
    }

    // update page
    public function updatePage($id) {
        $blog = Blog::where('id',$id)->first();
        $categories = Category::all();
        $admins = User::all();
        return view('admin.blog.updatePage',compact('blog','categories','admins'));
    }

    // delete blog
    public function delete ($id) {
        $oldImageName = Blog::where('id',$id)->first();
        if($oldImageName->image !== null) {
            $oldImageName = $oldImageName->image;
            Storage::delete('public/admin/blog/'.$oldImageName);
        }
        Blog::where('id',$id)->delete();
        Comment::where('blog_id',$id)->delete();

        return redirect()->route('admin#blog#list')->with(['deletedBlog' => 'Blog has been deleted']);
    }

    // validate blog
    private function validateBlog($request) {
        Validator::make($request->all(),[
            'title' => 'required|unique:products,name,'.$request->id,
            'image' => 'image|file|max:800|required_if:name,null',
            'description' => 'required',
            'categoryId' => 'required',
            'adminId' => 'required',
        ])->validate();
    }

    // convert to array data
    private function convertBlogDataToArray ($request) {
        return [
         'title' => $request->title,
         'description' => $request->description,
         'category_id' => $request->categoryId,
         'admin_id' => $request->adminId,
        ];
    }
}
