<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content', 'post_id', 'user_id',
    ];

    // Each comment belongs to one post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Each comment belongs to one user (author)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

