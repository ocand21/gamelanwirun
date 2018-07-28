<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Iklan;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'notelp', 'password', 'address', 'store_name', 'store_description', 'founded',
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
      return $this->belongsToMany(Role::class);
    }

    public function hasAnyRole($roles){
      if (is_array($roles)) {
        foreach ($roles as $role) {
          if ($this->hasRole($role)) {
            return true;
          }
        }
      } else {
        if ($this->hasRole($roles)) {
          return true;
        }
      }
      return false;
    }

    public function hasRole($role){
      if ($this->roles()->where('role_name', $role)->first()) {
        return true;
      }
      return false;
    }
        //
        // public function roles(){
        //   return $this->belongsToMany(Role::class);
        // }

    public function iklans(){
      return $this->hasMany(Iklan::class, 'user_id');
    }

    public function favouriteIklans(){
      return $this->morphedByMany(Iklan::class, 'favouriteable')
                  ->withPivot(['created_at'])
                  ->orderBy('pivot_created_at', 'desc');
    }

    public function wishlist(){
      return $this->hasMany(Wishlist::class);
    }



}
