<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Dotenv\Util\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::search()->latest('id')->paginate(5);
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Gate::authorize('create',Post::class);
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

//        return $request;


//        DB::transaction(function () use($request) {

        DB::beginTransaction();
        try{
            $post = new Post();
            $post->title = $request->title;
            $post->slug = $request->title;
            $post->description = $request->description;
            $post->excerpt = \Illuminate\Support\Str::words($request->description,20);
            $post->category_id= $request->category;
            $post->user_id = Auth::id();
            $post->is_publish = true;
            $post->save();

//        save tag to pivot table
            $post->tags()->attach($request->tags);

//        auto create folder
            if(!Storage::exists('public/thumbnail')){
                Storage::makeDirectory('public/thumbnail');
            }

            if($request->hasFile('photos')){
                foreach ($request->file('photos') as $photo){

//                store file
                    $newName = uniqid()."_photo.".$photo->extension();
                    $photo->storeAs('public/photo/',$newName);

//                making thumbnail Photo
                    $img = Image::make($photo);
//                reduce photo sizes
                    $img->fit(200,200);
                    $img->save('storage/thumbnail/'.$newName);//path::public/storage/thumbnail

//                save in db
                    $photo = new Photo();
                    $photo->name = $newName;
                    $photo->post_id = $post->id;
                    $photo->user_id = Auth::id();
                    $photo->save();
                }
            }
            DB::commit();
        }
        catch(\exception $e){
            DB::rollBack();
            throw $e;
        }




//        });

        return redirect()->route('post.index')->with('status','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
//        return $post;
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
//        return $post;
        Gate::authorize('update',$post);
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
//        return $request;

      $post->title = $request->title;
      $post->slug = \Illuminate\Support\Str::slug($request->title);
      $post->description = $request->description;
      $post->excerpt = \Illuminate\Support\Str::words($request->description,20);
      $post->category_id = $request->category;
      $post->update();

//        delete all record form pivot
        $post->tags()->detach();

//        save tag to pivot table
        $post->tags()->attach($request->tags);

      return redirect()->route('post.index')->with('status','post Updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        Gate::authorize('delete',$post);

//        return [$post,$post->photos];
        foreach ($post->photos as $photo){

            //file delete
            Storage::delete('public/photo/'.$photo->name);
            Storage::delete('public/thumbnail/'.$photo->name);


            //delete db record
//            $photo->delete();

        }

//        delete all record from hasMany
        $post->photos()->delete();

//        delete all record form pivot
        $post->tags()->detach();

        $post->delete();
        return redirect()->back()->with('status','Post delete');

    }
}
