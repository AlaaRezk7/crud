<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'category_id', 'user_id', 'is_published',
    ];

    // Each post belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Each post belongs to one user (author)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Each post can have many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

