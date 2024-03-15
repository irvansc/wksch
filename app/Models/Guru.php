<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Guru extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function scopeSearch($query, $value)
    {
        $query->where('name', 'LIKE', "%$value%")
        ->orWhere('gtk','LIKE',"%$value%")
        ->orWhere('alamat','LIKE',"%$value%");
    }
    public function getImgAttribute($value)
    {
       if ($value) {
        return asset('/storage/images/guru_images/thumbnails/resized_'.$value);
       }else {
        return asset('/back/dist/img/direktori/def-guru.jpg');
       }
    }

    // public function getTglLahirAttribute(){
    //     return Carbon::parse($this->attributes['tgl_lahir'])
    //     ->translatedFormat('l, d F Y');
    // }

}
