<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;



class ProfilesController extends Controller
{
    public function index(User $user)
    {
        // $userid = User::whereUsername($username)->firstOrFail();

        $postCount=Cache::remember('count.post.'.$user->id,
            now()->addSecond(30) ,
            function() use($user) {
            return $user->posts->count();
        },);
        $followersCount = Cache::remember('count.followers.'.$user->id,
            now()->addSecond(30) ,
            function() use($user) {
                return $user->profile->followers->count();
                
            },);

        $followingCount = Cache::remember('count.following.'.$user->id,
            now()->addSecond(30) ,
            function() use($user) {
                return $user->following->count();
            },);


//        determining whether th user already follows this profile
       $follows = (auth()->user()) ? auth()->user()->following->contains($user->id): false;

        return view('profiles.index',compact('user','follows','postCount','followersCount','followingCount'));
        }
    public function edit(User $user){

        //proctection using update policy
       $this -> authorize('update', $user->profile);
        return view('profiles.edit',compact('user'));
    }
    public function update(User $user){

        //proctection using update policy
       $this -> authorize('update',$user->profile);

        $data = request()->validate(
            [
                'title' =>'required',
                'description' => 'required',
                'url' => 'url',
                'image' => '',
            ]
        );

        if(request('image')){
            //finds the profile image path
            $imagePath=request('image')->store('profile','public');

            //image management using intervention package

            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1000);
            $image->save();
           $imageArray=['image'=> $imagePath];
        }
        $user->profile()->update(array_merge(
            $data,
            $imageArray ?? [],
        ));

        return redirect("/profile/{$user->username}");
    }
}
