<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

//    Eagar Loading,N1+query problem
    protected $with = ['user','category','photos','tags'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

//    accessor
//    public function getTitleAttribute($value){
//        return Str::words($value,10)."see more";
//    }

    public function getShortTitleAttribute(){
        return Str::words($this->attributes['title'],10);
    }
    public function getShowTimeAttribute(){
        return "<p class='mb-0 small'>
                    <i class='fa fa-calendar-alt'></i>
                    ".$this->created_at->format('Y-m-d')."
                </p>
                <p class='mb-0 small'>
                    <i class='fa fa-clock'></i>
                    ".$this->created_at->format('H:i a')."
                </p>";

//        <p class="small">
//          $post->created_at->diffForHumans()
//        </p>

    }

//    mutator
    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::slug($value);
    }

//    event
//    protected static function booted(){
//        static :: created(function (){
//            logger('hello hello hello');
//        });
//
//    }

//query Scope -> local scope
    public function scopeSearch($query){
        if(isset(request()->search)){
            $search = request()->search;
            return $query->where('title',"LIKE","%$search%")->orWhere('description',"LIKE","%$search%");
        }
    }

}
