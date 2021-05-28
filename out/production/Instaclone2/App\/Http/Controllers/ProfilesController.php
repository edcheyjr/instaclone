<?php

namespace App\Http\Controllers;

use App\Models\User;
use Intervention\Image\Facades\Image;


class ProfilesController extends Controller
{


    public function index(User $user)
    {
        //dd($user);
        //die and dump(dd) used to print out the data then stop everything
       /*alternative of finding the user manually
        $user=User::findOrFail($user);
        return view('profiles.index',[
            'user'=> $user,
            ]);*/
        //letting laravel find the user automatically
        return view('profiles.index',compact('user'));
        }
    public function edit(User $user){

        //proctection using update policy
       $this -> authorize('update', $user-> profile);

        return view('profiles.edit',compact('user'));

    }
    public function update(User $user){

        //proctection using update policy
        $this -> authorize('update', $user-> profile);

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
        auth()->user->profile()->update( array_merge(
            $data,
            $imageArray ?? [],
        ));


        return redirect("/profile/{$user->id}");
    }
}
