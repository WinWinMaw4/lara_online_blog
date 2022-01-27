@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @push('jsScript')
                        <script>
                            console.log("I'm bala bala")
                        </script>
                        @endpush

                    {{ __('You are logged in!') }}
                    {{request()->url()}}


                    <x-alert>
                        <h1>This is Alert box with component</h1>
                    </x-alert>
                    <x-alert type="info" margin="mb-5" class="text-uppercase fw-bold" title="san kyi tar par" aa="b c">
                        <h1>This is Alert box with component</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci alias aut, commodi deleniti dolore dolores facilis fuga nisi quae sint tempore! Adipisci aperiam est facere ipsa rem sequi ut?</p>
                    </x-alert>
                    <x-alert type="danger">
                        <h1>This is Alert box with component</h1>
                    </x-alert>

                        @inject('cat',"\App\Models\Category")

                        {{$cat->first()->title}}
                        {{$cat->first()->user_id}}

                        @hhz
{{--                        {{\App\Models\Category::first()->user_id}}--}}


{{--                    {{dd($my)}}--}}
                        {{$my->name}}
                        {{$my->age}}
                        {{$my->bf}}

                        {{$cat}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
