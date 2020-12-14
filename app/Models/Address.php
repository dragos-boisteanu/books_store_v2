<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Address extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'first_name',
        'district',
        'city',
        'address',
        'postal_code',
        'default_for_shipping',
        'default_for_invoice'
    ];

    protected $with = ['county', 'city'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    
    public function city() {
        return $this->hasOne('App\Models\City');
    }

    public function county() {
        return $this->hasOne('App\Models\County');
    }

    public function orders() {
        return $this->belongsToMany('App\Models\Order');
    }
}
