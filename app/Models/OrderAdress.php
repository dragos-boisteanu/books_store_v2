<?php

namespace App\Models;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderAdress extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'first_name',
        'district',
        'city',
        'address',
        'postal_code',
    ];

    public function order() 
    {
        return $this->belongsTo('App\Models\Order');
    }
    
    public function copyFromAddress($id)
    {
        $address = Address::findOrFail($id);

        $this->name = $address->name;
        $this->first_name = $address->first_name;
        $this->phone_number = $address->phone_number;
        $this->couty = $address->$conty;
        $this->city = $address->city;
        $this->address = $address->address;
        $this->postal_code = $address->postal_code;

        $this->save();
        
    }
}
