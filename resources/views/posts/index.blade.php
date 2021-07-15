@extends('layouts.app')

@section('content')
{{-- TODO add default view --}}
@if ($posts->count()==0)
<div class="container">
    <div class="row my-auto  no-gutters justify-content-center">
        <div class='col-8  col-lg-6 mx-auto col-auto'>
            <img src="{{ asset('img/emptyspace.png') }}" class="w-100" alt="emptyspaces">
            <p class="text-center font-weight-bold text">No Posts Yet</p>
        </div>
    </div>
</div>
@else
<div class="container-fluid">
    @foreach($posts as $post)
    <div class="row no-gutters justify-content-center">
        <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-4 ">
            <div class="row  no-gutters">
                <div class="d-flex">
                    <div class="pr-3">
                        <a href="{{route('profile.show', $post->user->username)}}">
                            <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width:45px">
                        </a>
                    </div>
                    <div class="align-items-center pt-2">
                        <div class="font-weight-bold">
                            <a href="{{route('profile.show', $post->user->username)}}">
                                <span class="text-dark">{{$post->user->username}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-2">
                <a href="{{route('post.single', $post->id)}}">
                    <img src="{{ asset('storage/'.$post->image) }}" class="w-100">
                </a>
            </div>
        </div>
    </div>
    <div class=" pt-4 pb-3">
        <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-6 offset-md-2 offset-lg-3 offset-xl-4 ">
            <p><span class="font-weight-bold ">
                    <a href="/profile/{{$post->user->username}}">
                        <span class="text-dark">{{$post->user->username}}</span>
                    </a>
                </span>
                {{$post->caption}}
            </p>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$posts->links()}}
        </div>
    </div>
</div>
@endif

@endsection
