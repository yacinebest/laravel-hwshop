<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;
    // protected $with =['orders'] ;
    // protected $appends =['isAdmin','isUser'];
    protected $appends =['isAdmin','isUser','commentCount','upVoteCount','downVoteCount' ,
    'orderApprovedByAdminCount','age','roleType'];

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


    public static function countAdmin()
    {
        return count(User::whereRoleId(Role::whereType('ADMIN')->first()->id)->get() );
    }

    public static function countUser()
    {
        return count(User::whereRoleId(Role::whereType('USER')->first()->id)->get() );
    }

    public static function count()
    {
        return count(User::all());
    }

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

    public function ordersApprovedByAdmin()
    {
        return $this->hasMany('App\Models\Order','admin_id');
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
    /**
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        return $this->role && $this->role->type === 'ADMIN';
    }

    /**
     * @return bool
     */
    public function getIsUserAttribute()
    {
        return $this->role  && $this->role->type === 'USER';
    }

     /**
     * @return number
     */
    public function getCommentCountAttribute()
    {
        return count($this->comments);
    }

     /**
     * @return number
     */
    public function getUpVoteCountAttribute()
    {
        return count($this->votes()->whereType('UP')->get());
    }
     /**
     * @return number
     */
    public function getDownVoteCountAttribute()
    {
        return count($this->votes()->whereType('DOWN')->get());
    }

     /**
     * @return number
     */
    public function getOrderApprovedByAdminCountAttribute()
    {
        return count($this->ordersApprovedByAdmin()->whereStatus('APPROVED')->get());
    }


    /**
     * Accessor for Age.
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }

    /**
     */
    public function getRoleTypeAttribute()
    {
        return $this->role->type;
    }

}
