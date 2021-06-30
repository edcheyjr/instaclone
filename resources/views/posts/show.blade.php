@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <img src="/storage/{{$post->image}}" class="w-75">
                </div>
                <div class="col-4">
                    <div class="d-flex align-items-center">
                        <div class="pr-3">
                            <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-100" style="max-width:45px ">
                        </div>
                        <div>
                            <div class="font-weight-bold ">
                                <a href="/profile/{{$post->user->username}}">
                                    <span class="text-dark">{{$post->user->username}}</span>
                                </a> .
                                <a>
                                    <follow-button seen="{{true}}"username="{{$post->user-> username}}" follows="{{$post->user->follows}}"></follow-button>
                                </a>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <p><span class="font-weight-bold pr-1">
                            <a href="/profile/{{$post->user->username}}">
                                <span class="text-dark">{{$post->user->username}}</span>
                            </a>
                        </span>
                        {{$post->caption}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection