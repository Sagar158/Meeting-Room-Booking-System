<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $fillable = ['first_name', 'last_name', 'email','phone_number','date_of_birth','gender','department_id','designation_id','date_of_joining','employment_status','address','country_id','city_id','reporting_manager','salary','employment_type','profile_image'];

    public static $employeeStatus = ['active' => 'Active', 'inactive' => 'Inactive', 'resigned' => 'Resigned'];
    public static $gender = ['male' => 'Male', 'female' => 'Female', 'other' => 'Other'];
    public static $employmentType = ['fulltime' => 'Full-Time', 'contract' => 'Contract', 'parttime' => 'Part-Time'];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
    public function meetings()
    {
        return $this->belongsToMany(Meeting::class, 'employee_meeting');
    }

}
