<?php

namespace App\Models;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
class Post extends Model implements Viewable
{
    use InteractsWithViews;
    use HasFactory;
    use Sluggable;
    protected $guarded =[];
    protected $removeViewsOnDelete = true;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'post_title'
            ]
        ];
    }

     public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('post_title','like',$term);
        });
    }

    public function subcategory() {
        return $this->belongsTo(SubCategory::class,'category_id','id');
    }
    public function author() {
        return $this->belongsTo(User::class,'author_id','id');
    }

    public function getFeatured_imageAttribute($value)
    {
       if ($value) {
        return asset('back/dist/img/default/'.$value);
       }else {
        return asset('back/dist/img/default/example.jpg');
       }
    }

}
