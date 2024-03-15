<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderAlumni extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function getImgAttribute($value)
    {
       if ($value) {
        return asset('/storage/images/album/slider/alumni/thumbnails/resized_'.$value);
       }else {
        return asset('/back/dist/img/direktori/slider_alumni.png');
       }
    }

}
