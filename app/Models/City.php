<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'county_id'
    ];

    public function county() {
        return $this->hasOne('App\Models\County');
    }
}
