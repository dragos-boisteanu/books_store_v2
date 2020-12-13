<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'adress_id',
        'payment_method_id',
        'status_id',
        'stage_id',
    ];

    protected $with = ['books', 'status', 'paymentMethod', 'address'];

    public function invoiceAddress() {
        return $this->hasOne('App\Model\Adress', 'invoice_address_id');
    }

    public function shippingAddress() {
        return $this->hasOne('App\Model\Adress', 'shipping_address_id');
    }

    public function paymentMethod() {
        return $this->hasOne('App\Model\PaymentMethod');
    }

    public function status() {
        return $this->hasOne('App\Model\Status');
    }

    public function books() {
        return $this->hasMany('App\Models\OrderBooks');
    }

    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }

}
