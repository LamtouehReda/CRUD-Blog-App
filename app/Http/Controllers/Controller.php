<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(){
        $posts=Post::paginate(3);
        return view('home')->with([
            'posts'=>$posts
        ]);
    }

    public function add_post(){
        $this->authorize('create', Post::class);
        return view('add-post');
        
    }

    public function store_post(Request $request){

        $request->validate([
            'title'=>'required|min:5|max:100',
            'image'=>'required|mimes:png,jpg,jpeg|max:2048',
            'body'=>'required|min:10|max:10000'
        ]);

        if($request->has('image')){
            $image=$request->image;
            $image_name=time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'),$image_name);
        }

        $title=$request->title;
        Post::create([
            'title'=>$title,
            'slug'=>Str::slug($title),
            'image'=>$image_name,
            'body'=>$request->body,
            'user_id'=>auth()->user()->id
        ]);

        $slug=Str::slug($request->title);

        return redirect()->route('post-details',$slug)->with([
                'success'=>'Post Added Successfully'
            ]);
    }

    public function post_details($slug){
        $post=DB::table('posts')->where('slug',$slug)->first();
        return view('post-details')->with(['post'=>$post]);
    }

    public function edit_post($slug){

        $post=DB::table('posts')->where('slug',$slug)->first();
        if(auth()->check()){
            if(auth()->user()->user_id===$post->id || auth()->user()->is_admin){
                return view('edit-post')->with([
                'post'=>$post
            ]);  
            }
             
        }
        return redirect()->route('home');
        
    }

    public function store_edited_post(Request $request,$slug){
        $request->validate([
            'title'=>'required|min:5|max:100',
            'image'=>'mimes:png,jpg,jpeg|max:2048',
            'body'=>'required|min:10|max:1000'
        ]);

        $post=Post::where('slug',$slug)->first();

        if($request->has('image')){
            $image=$request->image;
            $image_name=time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'),$image_name);
            unlink(public_path('uploads/').$post->image);
            $post->image=$image_name;
        }

        $title=$request->title;
        $post->update([
            'title'=>$title,
            'slug'=>Str::slug($title),
            'image'=>$post->image,
            'body'=>$request->body
        ]);

        $slug=Str::slug($request->title);

        return redirect()->route('post-details',$slug)->with([
                'success'=>'Post Updated Successfully'
            ]);
    }

    public function delete_post(Request $request,$slug){
        $post=Post::where('slug',$slug)->first();
        $post->delete();
        unlink(public_path('uploads/').$post->image);
        return redirect()->route('home')->with([
            'success'=>'Post Deleted Successfully'
        ]);
    }

}
