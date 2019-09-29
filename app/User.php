<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password', 'username', 'last_name', 'dob',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * relation oneToMany to post table
     */
    public function topics() {
        return $this->hasMany(Post::class);
    }

    /**
     * relation oneToMany to comment table
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    /**
     * relation oneToMany to role table
     */
    public function roles(){
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function hasRole($role){
        return null !== $this->roles()->where('name', $role)->first();
    }
}
