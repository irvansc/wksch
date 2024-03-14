<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        ''
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getPictureAttribute($value)
    {
       if ($value) {
        return asset('back/dist/img/admins/'.$value);
       }else {
        return asset('back/dist/img/admin/default.png');
       }
    }
    public function adminType()
    {
        return $this->belongsTo(Type::class, 'type', 'id');
    }

    public function posts() {
        return $this->hasMany(Post::class, 'author_id', 'id');
    }


    public function scopeSearch($query, $term)
    {
        $term = "%$term";
        $query->where(function($query)use ($term){
            $query->where('name','like',$term)->orWhere('email','like', $term);
        });
    }
}
