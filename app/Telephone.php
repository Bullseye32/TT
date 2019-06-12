<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    // protected $table = 'telephones';

    // protected $fillable = ['user_id','contact','ext_number'];

    public function user_info(){
        return $this->belongsTo('App\User','user_id');
    // a tele-contact has 1 user i.e. 'user_id'
    }
}
