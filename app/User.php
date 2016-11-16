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
}
