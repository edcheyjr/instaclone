<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }

    //controller for posting photos
    public function create(){
        //returns posts to be viewed
        return view('posts.create');
    }
    //

    public function store(){

        //checks or validates where all the fields caption and image have been filled correctly
        $data=request()->validate([
            'caption'=>'required',
            'image'=>['required','image'],
        ]);

        //finds the image path
       $imagePath=request('image')->store('uploads','public');

        //image management using intervention package
       $image= Image::make(public_path("storage/{$imagePath}"))->fit(1200);
       $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image'=>$imagePath,
        ]);

        //dd(request()->all());
       return redirect('/profile/'.auth()->user()->id);
    }

    public function show(Post $post){

       return view('posts.show',compact("post"));
    }
}
