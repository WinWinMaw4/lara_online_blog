@extends('layouts.app')
@section('content')
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="m-3">
                        <a href="{{route('post.index')}}" class="">
                            <i class="fas fa-arrow-left fa-fw fa-1x"></i>
                        </a>
                    </div>
                    <div class="card-header h4">
                        {{$post->title}}
                    </div>
                    <div class="card-body">
                        <div class="">
                            <span>
                                <i class="fa fa-user fa-fw"></i>
                                {{$post->user->name}}
                            </span>
                            <span title="category">
                                <i class="fas fa-layer-group fa-fw"></i>
                                {{$post->category->title}}
                            </span>
                        </div>
                        {{$post->description}}
                        <hr>
                        <div class="">
                            <a href="{{route('post.create')}}" class="btn btn-primary">
                                Create Post
                            </a>
                            <a href="{{route('post.index')}}" class="btn btn-outline-primary">
                                All Post
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
