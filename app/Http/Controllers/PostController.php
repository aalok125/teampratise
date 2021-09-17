<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(10);
        return view ('post.index',compact('posts'))
    }

    public function create(){
        return view('post.create');
    }   

     public function store(Request $request){

            
    }
     public function edit(Request $request User $user){
        
    }
     public function update(Request $request User $user){
        
    }
     public function delete(){
        
    }
}
