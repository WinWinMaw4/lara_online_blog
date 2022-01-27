@extends('layouts.app')
@section('content')
    <main class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                       Category
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="">
                                @can('create',\App\Models\Post::class)
                                <a href="{{route('post.create')}}" class="btn btn-primary">
                                    Posts Create
                                </a>
                                @endcan
                                @isset(request()->search)
                                    <a href="{{route('post.index')}}" class="btn btn-outline-primary">
                                        All Post
                                    </a>
                                    <span>Search By : "{{request()->search}}</span>
                                @endisset
                            </div>
                            <form method="get" class="w-25">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" value="{{request('search')}}" placeholder="search something..">
                                    <button class="btn btn-primary" type="submit" >
                                        <i class="fas fa-search fa-fw"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

{{--                        @json(request()->all());--}}
                        <table class="table table-hover align-middle">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="w-25">title</th>
                                <th>Photo</th>
                                <th>is Publish</th>
                                <th>Category</th>
                                <th>Tag</th>
                                <th>Owner</th>
                                <th>Control</th>
                                <th>Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td class="small">{{$post->short_title}}</td>
                                    <td class="text-nowrap">
{{--                                        href="{{asset('storage/photo/'.$photo->name)}}"--}}
{{--                                        @forelse($post->photos()->latest('id')->limit(3)->get() as $photo)--}}
                                        @forelse($post->photos as $key=>$photo)
                                            @if($key == 3)
                                                @break
                                            @endif
                                            <a class="venobox" data-gall="img{{$post->id}}" data-maxwidth="500px"  title="{{$post->title}}" href="{{asset('storage/photo/'.$photo->name)}}">
                                                <img src="{{asset('storage/thumbnail/'.$photo->name)}}" height="30" class="rounded-circle border border-2 border-white shadow-sm list-thumbnail" alt="image alt"/>
                                            </a>
                                       @empty
                                           <p class="text-muted">No Photo</p>
                                       @endforelse
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="isPublish" {{$post->is_publish? 'checked':''}}>
                                            <label class="form-check-label" for="isPublish">
                                                {{$post->is_publish? 'Publish':'Un_publish'}}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        {{$post->category->title ?? "Unknown Category"}}
                                        <br>
                                    </td>
                                    <td>
                                        @foreach($post->tags as $tag)
                                            <span class="badge bg-primary small">
                                                <i class="fas fa-hashtag"></i>
                                                {{$tag->title}}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{$post->user->name ?? "Unknown User" }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('post.show',$post->id)}}" class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-info-circle fa-fw"></i>
                                            </a>
                                            @can('update',$post)
                                                <a href="{{route('post.edit',$post->id)}}" class="btn btn-sm btn-outline-warning">
                                                    <i class="fa fa-pencil-alt fa-fw"></i>
                                                </a>
                                            @endcan
                                            @can('delete',$post)
                                                <button class="btn btn-sm btn-outline-danger" form="postDeleteForm{{$post->id}}">
                                                    <i class="fa fa-trash-alt fa-fw"></i>
                                                </button>
                                            @endcan
                                        </div>
                                        @can('delete',$post)
                                            <form action="{{route('post.destroy',$post->id)}}" id="postDeleteForm{{$post->id}}" method="post" class="d-inline-block" l>
                                                @csrf
                                                @method('delete')
                                            </form>
                                        @endcan
                                    </td>
                                    <td>
                                        {!! $post->show_time !!}
                                        {{--                                            <p class="small">--}}
                                        {{--                                                {{$post->created_at->diffForHumans() }}--}}
                                        {{--                                            </p>--}}

                                    </td>
                                </tr>

                            @empty
                                <tr >
                                    <td colspan="8"  class="text-center">There is no category</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between">
                            {{$posts->appends(request()->all())->links()}}
                            <p class="fw-bolder h4">Total:{{$posts->total()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
