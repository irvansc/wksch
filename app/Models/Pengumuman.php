<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Carbon;
use CyrildeWit\EloquentViewable\InteractsWithViews;
class Pengumuman extends Model implements Viewable
{
    use HasFactory;
    use Sluggable;
    use InteractsWithViews;
    protected $guarded = [''];
    protected $removeViewsOnDelete = true;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('l, d F Y');
    }
    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('l, d F Y');
    }
}
