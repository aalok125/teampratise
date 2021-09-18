<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Post;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(10);
        return view ('post.index',compact('posts'));
    }

    public function create(){


        return view('backend.post.create');
    }

     public function store( PostStoreRequest $request){
        $post= new Post();
        $post->post_title =  $request->get ('post_title');
        $post->post_slug = str_slug ($request->get('post_title'));
        $post->post_status = $request->get ('status');
        $post->is_punlished = $request->get ('is_published');
        $post->post_content = $request->get  ('post_content');
        $post->user_id = Auth()->id();
         $post->save();

    }
     public function edit(Request $request ,User $user){

    }
     public function update(Request $request, User $user){

    }
     public function delete(){


        Session::flash ('success','Post Has Been Created Successfully.');
        return redirect()->route('posts.index');

    }
}
