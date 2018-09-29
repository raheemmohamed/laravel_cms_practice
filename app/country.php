<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    //
    public function post(){
        //first post class, a user model, foreign key of user table, user_id for post foreign key
         return $this->hasManyThrough('App\Post', 'App\User', 'country_id', 'userId');
    }
}
