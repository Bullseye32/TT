<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $dates =[
        'created_at',
        'updated_at',
        'deadline',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
        // a task belongs to many users
        // gives list of assigned-staff
    }

    public function creator()
    {
        return $this->belongsTo('App\User','createdBy');
        // 1 task -> 1 creator user
        // that user is set at 'tasks' table 'createdBy' column
    }
}
