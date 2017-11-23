<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'is_active',
        'author',
        'email',
        'photo',
        'body',
    ];

    public function replies()
    {
        return $this->hasMany('App\CommentReply');
    }

    public function activeReplies()
    {
        return $this->hasMany('App\CommentReply')->active();
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
