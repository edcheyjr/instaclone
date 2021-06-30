@extends('layouts.app')

@section('content')
<div class="container align-items-center">
    <div class="row">
        <div class="col-3 p-3">
            <img src="{{$user->profile->profileImage()}}" class="rounded-circle w-75">
        </div>
        <div class="col-9 pt-3">
            <div class="d-flex justify-content-between align-items-baseline">

                <div class="d-flex align-items-center pb-4">
                    <div class="h4 text-center">{{$user ->username}}</div>
                    {{-- follow-button--}}
                    @guest
                    @if($user->id)
                    <follow-button seen="{{false}}" user_id=" {{$user->id}}" follows="{{$follows}}"></follow-button>
                    @endif
                    @else
                    @if(auth()->user()->id!= $user->profile->user_id)
                    <follow-button username="{{$user -> username}}" follows="{{$follows}}"></follow-button>
                    @endif
                    @endguest
                </div>
                @can('update', $user->profile)
                <a href="/p/create" class="text-primary">add new post</a>
                @endcan
            </div>
            <div>
                @can('update', $user->profile)
                <a href="/profile/{{ $user->username}}/edit" class="text-primary">edit profile</a>
                @endcan
            </div>
            <div class="d-flex">
                <div class="pr-4"><strong>{{$postCount}}</strong> posts</div>
                <div class="pr-4"><strong>{{$followersCount}}</strong> followers</div>
                <div class="pr-4"><strong>{{$followingCount}}</strong> following</div>
            </div>
            <div class="pt-3 font-weight-bold">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>
            <div><a href="#">{{$user->profile->url ?? 'N/A'}}</a></div>

        </div>
    </div>
    <div class="row pt-4">
        {{-- TODO add default view --}}
        @foreach($user->posts as $post)
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 pb-5">
            <a href="/p/{{$post->id}}">
                <img src="/storage/{{$post->image}}" class="w-100">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection