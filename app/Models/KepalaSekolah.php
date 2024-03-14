<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaSekolah extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function getImgAttribute($value)
    {
       if ($value) {
        return asset('/back/dist/img/kepala/'.$value);
       }else {
        return asset('/back/dist/img/kepala/kepala.png');
       }
    }

}
