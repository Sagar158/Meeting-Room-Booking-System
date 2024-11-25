<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    protected $table = 'cities';
    protected $fillable = [
        'name',
        'state_id',
        'state_code',
        'country_id',
        'country_code',
        'latitude',
        'longitude',
        'flag',
        'wikiDataId'
    ];

    public function country()
    {
        return $this->hasOne(Countries::class,'id', 'country_id');
    }
    public function state()
    {
        return $this->hasOne(State::class,'id', 'state_id');
    }

}
