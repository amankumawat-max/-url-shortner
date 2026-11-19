<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;
    protected $table = 'short_urls';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'short_code',
        'long_url',
        'hits',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function urlHits()
    {
        return $this->hasMany(UrlHit::class, 'short_url_id');
    }
}
