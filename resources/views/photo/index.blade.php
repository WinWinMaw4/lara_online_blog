@extends('layouts.app')
@section('content')
    <main class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        My Photo
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="">
                                <a href="{{route('photo.index')}}" class="btn btn-primary">
                                    My Photo List
                                </a>
                                @isset(request()->search)
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


                        <div class="mb-3 d-flex flex-wrap">

                            @forelse(auth()->user()->photos as $photo)
                                <div class="position-relative me-1 mb-1">
                                    <form action="{{ route('photo.destroy',$photo->id) }}" class="position-absolute bottom-0 start-0" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    <a class="venobox" data-gall="img" data-maxwidth="500px"  href="{{ asset('storage/photo/'.$photo->name) }}">
                                        <img src="{{ asset('storage/photo/'.$photo->name) }}"  height="200" class="rounded-3" alt="image alt"/>
                                    </a>
                                </div>
                            @empty
                                <p class="text-muted">No Photo</p>
                            @endforelse
                        </div>


{{--                        <div class="d-flex justify-content-between">--}}
{{--                            {{$posts->appends(request()->all())->links()}}--}}
{{--                            <p class="fw-bolder h4">Total:{{$posts->total()}}</p>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
