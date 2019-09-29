<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'tags', 'user_id',
    ];

    /**
     * relation manyToOne to users table
     */
    public function user() {
        return $this->belongsTo(User::class, "user_id")->select("id", "username");
    }

    /**
     * @return mixed
     */
    public function commentsCount()
    {
        $posts = Post::loadCount('comments')->get();
        return $posts;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment() {
        return $this->hasMany(Comment::class);
    }
}
