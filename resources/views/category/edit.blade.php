@extends('layouts.app')
@section('content')
    <main class="container">
        <div class="row">
            <div class="col-12">
                <div class="h4 text-muted">
                    Edit Category
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('category.update',$category->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="row align-items-end">
                                <div class="col-6 col-md-3">
                                    <label for="title" class="form-label text-muted">Category title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title',$category->title)}}">
                                </div>
                                <div class="col-6 col-md-3">
                                    <button class="btn btn-primary">Update Category</button>
                                </div>
                            </div>
                            @error('title')
                            <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
