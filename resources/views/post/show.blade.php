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
                        <div class="">{{$post->description}}</div>
{{--                        photo--}}
                        <div class="mb-3 d-flex flex-wrap">

                            @forelse($post->photos as $photo)
                                <div class="position-relative me-1 mb-1">
                                    <form action="{{ route('photo.destroy',$photo->id) }}" class="position-absolute bottom-0 start-0" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    <a class="venobox" data-gall="img" data-maxwidth="500px" title="{{$post->short_title}}"  href="{{ asset('storage/photo/'.$photo->name) }}">
                                        <img src="{{ asset('storage/photo/'.$photo->name) }}"   height="200" class="rounded-3" alt="image alt"/>
                                    </a>
                                </div>
                            @empty
                                <p class="text-muted">No Photo</p>
                            @endforelse
                        </div>

                        <div class="mb-3">
                            @foreach($post->tags as $tag)
                                <span class="badge bg-primary small">
                                                <i class="fas fa-hashtag"></i>
                                                {{$tag->title}}
                                            </span>
                            @endforeach
                        </div>
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
