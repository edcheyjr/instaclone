<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
//    uses the construct function to require a middleware auth()
// hence only continues to post if the user is authorized asin logged in
   public function __construct()
   {
       $this->middleware('auth');
   }

   public  function index(){
//       displaying Users Profiles

       $user = auth()->user()->following->pluck('user_id');
//       $owner= auth()->user()->profile->pluck('user_id');
       $users_array=$user;
//       orderby('created_at', 'DESC') same with latest
//TODO:displays latest post by the user and his followers
       (auth()->user()->posts->count()!=0)
       ?
           $posts = Post::whereIn('user_id',$users_array)->with('user')->latest()->paginate(5)
       :
           $posts = Post::whereIn('user_id',$user)->with('user')->latest()->paginate(5);

//       dd($post);
      return view('posts.index',compact("posts"));
   }

    //controller for posting photos
    public function create(Post $post){
//       authorize
//        $this->authorize('update',$post->user);
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
