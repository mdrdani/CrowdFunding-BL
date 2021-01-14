<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable, UsesUuid;

    protected function get_user_role_id()
    {
        $role = \App\Role::where('role_name','user')->first();
        return $role->id;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->role_id = $model->get_user_role_id();
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

<<<<<<< HEAD
    public function isAdmin()
    {
        if($this->role_id === $this->get_user_role_id()){
            return false;
        }
        return true;
=======
    public function isAdmin(){
        if($this->role_id == 'aadb2d0a-d846-40f3-9e5e-1ea368bc00bc'){
            return true;
        }
        return false;
    }

    public function isVermail(){
        if($this->email_verified_at != null){
            return true;
        }
        return false;
>>>>>>> 11b5dd8d4a23d9fd44b9ef3d6cf811be9ea35985
    }
}