<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /*method for one to one relationship with foreign key with post table*/
    public function userPost(){
        $onetoonerelated = $this->hasOne('App\Post','userId');
        return $onetoonerelated;
    }

    /*One to many relationship with foreign key */
    public  function userPosts(){
        $oneToMany = $this->hasMany('App\Post','userId');
        return $oneToMany;
    }

    /*many to many relationship elequent*/
    public function rolees(){
        $manyToMany = $this->belongsToMany('App\Role', 'role_user','role_id','userId');
        return $manyToMany;
    }

    /*piviot elquent to check Intermidiate table info*/

    public function pivoted(){
       $piviot = $this->belongsToMany('App\Role','role_user', 'role_id','userId')->withPivot('created_at');

       return $piviot;
    }

    /*
    |--------------------------------------------------
    | Laravel Polynmorphic ::user
    |---------------------------------------------------
    */
    //polymorfiq abstract a data
    public function photoes(){
      // return $this->morphMany('App\Photo', 'imageable');
        //return $this->morphMany('App\Photo', 'imageables');

          //  return $this->morphMany('App\Photo','id','imageable_id', 'imageable_type');

        return $this->morphMany('App\Photo','imageables', 'imageable_type','imageable_id');
    }

}
