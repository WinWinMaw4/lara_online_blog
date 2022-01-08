@extends('layouts.app')
@section('content')
    <main class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{route('category.create')}}" class="btn btn-primary">
                                Category Lists
                            </a>
                        </div>
                        @if(session('status'))
                            <p class="alert alert-success">
                                <i class="far fa-check-circle fa-fw"></i>
                                {{session('status')}}
                            </p>
                        @endif
                        <table class="table table-hover align-middle">
                            <thead>
                               <tr>
                                   <th>#</th>
                                   <th>title</th>
                                   <th>Owner</th>
                                   <th>Control</th>
                                   <th>Created</th>
                               </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->title}}</td>
                                        <td>
                                            {{$category->user->name ?? "Unknown User" }}
                                        </td>
                                        <td>
                                            <form action="{{route('category.destroy',$category->id)}}" method="post" class="d-inline-block" l>
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash-alt fa-fw"></i>
                                                </button>
                                            </form>
                                            <a href="{{route('category.edit',$category->id)}}" class="btn btn-sm btn-warning">
                                                <i class="fa fa-pencil-alt fa-fw"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <p class="mb-0 small">
                                                <i class="fa fa-calendar-alt"></i>
                                                {{$category->created_at->format("Y-m-d")}}
                                            </p>
                                            <p class="mb-0 small">
                                                <i class="fa fa-clock"></i>
                                                {{$category->created_at->format("H:i a")}},

                                            </p>
{{--                                            <p class="small">--}}
{{--                                                {{$category->created_at->diffForHumans() }}--}}
{{--                                            </p>--}}

                                        </td>
                                    </tr>

                                @empty
                                    <tr >
                                        <td colspan="5"  class="text-center">There is no category</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
