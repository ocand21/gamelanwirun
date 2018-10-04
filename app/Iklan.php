<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Iklan extends Model
{
    protected $fillable = ['judul', 'url', 'user_id', 'category_id', 'deskripsi', 'volume', 'stock', 'harga', 'notelp', 'view_count'];


    public function category(){
      return $this->belongsTo('App\Category');
    }

    public function users(){
      return $this->belongsTo(User::class,'user_id');
    }

    public function favourites(){
      return $this->morphToMany(User::class, 'favouriteable');
    }

    public function favouritedBy(User $user){
      return $this->favourites->contains($user);
    }

    public function store(){
      return $this->belongsTo(Store::class);
    }

    public function wishlist(){
      return $this->hasMany(Wishlist::class);
    }

    public function photos(){
      return $this->hasMany(IklansPhoto::class,'iklan_id');
    }

}
