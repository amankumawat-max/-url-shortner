<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'client_id',
        'name',
        'email',
        'password_hash',
        'role',
        'status',
        'invite_token',
    ];

    protected $hidden = [
        'password_hash',
        'invite_token',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function teamMembers()
    {
        return $this->hasMany(User::class, 'client_id');
    }

    public function shortUrls()
    {
        return $this->hasMany(ShortUrl::class, 'user_id');
    }
}
