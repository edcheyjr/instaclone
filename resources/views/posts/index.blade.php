@extends('layouts.app')

@section('content')
{{--  TODO add default view --}}
    <div class="container">
        @foreach($posts as $post)
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="row">
                        <div class="d-flex">
                            <div class="pr-3">
                                <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-100" style="max-width:45px">
                            </div>
                            <div class="align-items-center pt-2">
                                <div class="font-weight-bold">
                                    <a href="/profile/{{$post->user->id}}">
                                        <span class="text-dark">{{$post->user->username}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                    <img src="/storage/{{$post->image}}"class="w-75">
                    </div>
                </div>
            </div>
            <div class=" pt-4 pb-3">
                <div class="col-6 offset-3">
                    <p><span class="font-weight-bold ">
                            <a href="/profile/{{$post->user->id}}">
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
@endsection
