<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = ['title', 'organizer', 'meeting_date', 'start_time', 'end_time'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_meeting');
    }
}
