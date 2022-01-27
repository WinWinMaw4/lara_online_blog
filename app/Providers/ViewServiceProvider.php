<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();
//        @wwm
        Blade::directive('wwm',function (){
            return '<h1>Win Win Maw</h1>';
        });

//        Blade::directive('wwm',fn()=>"h1>Win Win Maw</h1>");
//        Blade::if('onlyAdmin',fn()=>auth()->user()->role === 'admin');
        Blade::if('onlyAdmin',function (){
            return auth()->user()->role === 'admin';
        });


        View::share("my",(Object)["name"=>"Win Win Maw","age"=>22,"bf"=>"Ko"]);



        View::composer('home',function (){
            View::share("cat",Category::all());
        });

    }
}
