<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function scopeSearch($query, $value)
    {
        $query->where('title', 'LIKE', "%$value%")
        ->orWhere('url_video','LIKE',"%$value%")
        ;
    }
}
