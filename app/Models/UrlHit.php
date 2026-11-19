<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlHit extends Model
{
    use HasFactory;
    protected $table = 'url_hits';
    protected $primaryKey = 'id';

    protected $fillable = [
        'short_url_id',
        'hit_at',
    ];

    public function shortUrl()
    {
        return $this->belongsTo(ShortUrl::class, 'short_url_id');
    }
}
