<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskRemark extends Model
{
    protected $table = "task_remarks";
    // public $tmestamps = false;

    public function remarkedBy(){
        return $this->belongsTo('App\User','user_id');
    }
}
