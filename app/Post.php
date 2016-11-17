<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Establish relationship to User (created by user)
    // We will store a foreign key of the user who created the post
    // in the user_id column
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Establish relationship to 'Likes'
    // One user can have many likes
    // user_id will be store in each like
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

}
