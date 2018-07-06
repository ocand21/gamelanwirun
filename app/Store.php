<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Store extends Model
{
    protected $fillable = ['user_id', 'store_name', 'description', 'foundedin'];

    public function users(){
      return $this->belongsTo(User::class);
    }

    public function iklan(){
      return $this->hasMany(Iklan::class, 'user_id');
    }

}
