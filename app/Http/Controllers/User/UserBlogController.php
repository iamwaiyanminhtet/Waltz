<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class UserBlogController extends Controller
{
    // list
    public function list () {
        $categories = Category::all();
        $blogs = Blog::all();
        $blogList = Blog::select('blogs.*','categories.name as category_name')
        ->leftJoin('categories','blogs.category_id','categories.id')->paginate(15);
        $comments = Comment::all();

        return view('user.blog.list',compact('categories','blogs','blogList','comments'));
    }

    // sort by category
    public function sortByCategory (Request $request) {
        if($request->categoryId !== 'all') {
            $blogs = Blog::select('blogs.*','categories.name as category_name')
            ->leftJoin('categories','blogs.category_id','categories.id')
            ->where('blogs.category_id',$request->categoryId)->paginate(15);
            $comments = [];
            foreach ($blogs as $blog) {
                $comment = Comment::select('comments.*')->leftJoin('blogs','comments.blog_id','blogs.id')->where('comments.blog_id',$blog->id)->count();
                array_push($comments,$comment);
            }
            $response = [
                'blogs' => $blogs,
                'comments' => $comments
            ];

            return response()->json($response);
        }else {
            $blogs = Blog::select('blogs.*','categories.name as category_name')
            ->leftJoin('categories','blogs.category_id','categories.id')
            ->paginate(15);
            $comments = [];
            foreach ($blogs as $blog) {
                $comment = Comment::select('comments.*')->leftJoin('blogs','comments.blog_id','blogs.id')->where('comments.blog_id',$blog->id)->count();
                array_push($comments,$comment);
            }
            $response = [
                'blogs' => $blogs,
                'comments' => $comments
            ];

            return response()->json($response);
        }

    }
    // sorted blog comments
    public function sortedBlogComments (Request $request) {
        $comments = Comment::where('blog_id',$request->id)->count();
        return response()->json($comments);
    }

    // single blog
    public function singleBlog ($blogId) {
        $blog = Blog::select('blogs.*','users.name as username','users.image as user_image','users.gender as gender','categories.name as category_name','categories.id as category_id')
        ->leftJoin('users','blogs.admin_id','users.id')->where('blogs.id',$blogId)
        ->leftJoin('categories','blogs.category_id','categories.id')
        ->first();

        $relatedBlogs = Blog::select('blogs.*','categories.name as category_name')
        ->leftJoin('categories','blogs.category_id','categories.id')
        ->where('blogs.category_id',$blog->category_id)
        ->where('blogs.id','!=',$blogId)
        ->get()->take(4);

        $comments = Comment::all();
        $currentBlogComments = Comment::select('comments.*','users.name as username','users.image as user_image','users.gender as gender')->where('comments.blog_id',$blogId)
        ->leftJoin('users','comments.user_id','users.id')
        ->get()->all();
        return view('user.blog.single',compact('blog','relatedBlogs','comments','currentBlogComments'));
    }
}
