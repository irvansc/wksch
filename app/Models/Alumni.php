<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Alumni extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function scopeSearch($query, $value)
    {
        $query->where('name', 'LIKE', "%$value%")
        ->orWhere('telp','LIKE',"%$value%")
        ->orWhere('email','LIKE',"%$value%")
        ->orWhere('nis','LIKE',"%$value%")

        ;
    }

    public function getImgAttribute($value)
    {
       if ($value) {
        return asset('storage/images/alumni_images/thumbnails/resized_'.$value);
       }else {
        return asset('/back/dist/img/direktori/def-alumni.jpg');
       }
    }

    public function getTglLahirAttribute(){
        return Carbon::parse($this->attributes['tgl_lahir'])
        ->translatedFormat('l, d F Y');
    }
}
