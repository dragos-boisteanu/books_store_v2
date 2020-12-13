<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class County extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'auto'
    ];

    public function city() {
        return $this->hasMany('App\Models\City');
    }
}
