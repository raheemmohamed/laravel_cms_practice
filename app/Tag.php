<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

    public function tagposts(){
        return $this->morphedByMany('App\Post','taggable','taggables');
    }

    public function tagvideo(){
        return $this->morphedByMany('App\Video','taggable','taggables');
    }
}
