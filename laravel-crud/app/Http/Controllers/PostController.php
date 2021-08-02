<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Mail\welcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PostController extends Controller
{
    function signUp(Request $req){
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        return $user;
    }
    function login(Request $req){
        $user = User::where("email",$req->email)->first();
        if(!$user||!Hash::check($req->password,$user->password)){
            return ["Err"=>"email or password is not matched"];
        }
        return $user;
    }
    
    function create(Request $req){
        $post = new Post;
        $post->title = $req->input('title');
        $post->body = $req->input("body");
        $post->file_path = $req->file('file')->store('postimages');
        $post->save();
        return $post;
        // return $req->file("file")->store('post_images');

    }
    function show(){
        return $post = Post::all();
    }
    function delete($id){
        $post = Post::where('id',$id)->delete();
        if($post){
            return "data has been deleted!";
        }
    }
    function edit($id){
        $post = Post::where('id',$id)->get();
        return $post;
    }
     function update(Request $request){
        // return dd($request);
         $post = Post::where('id',$request->id)         
        ->update([
            
            'title' => $request->title,
            'body'=>$request->body
        ]);   
        
        
    }
    function sendMail($id){
        $post = User::where('id',$id)->get('email');
        Mail::to($post)->send(new welcomeMail());
        return "message sent!";
    }
 
}
