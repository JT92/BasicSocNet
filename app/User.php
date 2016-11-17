<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    // Establish relationship to posts (can have many posts)
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    // Establish relationship to 'Likes'
    // One post can have many likes from many users
    // user_id will be store in each like
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
