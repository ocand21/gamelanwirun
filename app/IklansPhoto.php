<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IklansPhoto extends Model
{
    protected $fillable = ['iklan_id', 'filename'];

    public function iklan(){
      return $this->belongsTo('App\Iklan');
    }
}
