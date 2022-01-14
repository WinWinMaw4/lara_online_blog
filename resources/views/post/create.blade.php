@extends('layouts.app')
@section('content')
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                <div class="card">
                    <div class="card-header h4">
                        Create Post
                    </div>
                    <div class="card-body">
                        <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label text-muted">Post title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}">
                                @error('title')
                                <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <select name="category" class="form-select @error('category') is-invalid @enderror">
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option value="{{$category->id}}" {{$category->id == old('category') ? "selected":''}}>{{$category->title}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label text-muted">Photo</label>
                                <input type="file" name="photo[]" class="form-control @error('photo') is-invalid @enderror" multiple>
                                @error('photo')
                                <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label text-muted">Description</label>
                                <textarea type="text" rows="10" name="description" class="form-control @error('description') is-invalid @enderror">
                                    {{old('description')}}
                                </textarea>
                                @error('description')
                                <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="confirm" required>
                                    <label class="form-check-label" for="confirm">Confirm</label>
                                </div>
                                <button class="btn btn-primary">Create Post</button>
                            </div>

                        </form>
{{--error တက်နေလို့ ပြန်စစ်ပါ--}}
{{--                        @if ($errors->any())--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                <ul>--}}
{{--                                    @foreach($errors->all() as $error)--}}
{{--                                        <li>{{$error}}</li>--}}
{{--                                    @enderror--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        @endif--}}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
