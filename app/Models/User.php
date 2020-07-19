<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;
    // protected $with =['role','orders'] ;

    // Disable Incrementing
    public $incrementing = false;

    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            $model->{$model->getKeyName()} = (string)Str::uuid();
        });
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','firstname','lastname','username','address',
        'birth_date','gender','country','phone_number','role_id','avatar'
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


/*
|---------------------------------------------------------------------------|
| RELATIONSHIP                                                              |
|---------------------------------------------------------------------------|
*/
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    // public function images()
    // {
    //     return $this->morphMany('App\Models\Image', 'imageable');
    // }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function votes()
    {
        return $this->hasMany('App\Models\Vote');
    }


/*
|---------------------------------------------------------------------------|
| GETTER & SETTER                                                           |
|---------------------------------------------------------------------------|
*/
    // public function commentCount()
    // {
    //     return count('comments');
    // }

    // public function count($entity)
    // {
    //     return count($this->user->$entity);
    // }
}
