<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_address_id',
        'shipping_address_id',
        'payment_method_id',
        'shipping_method_id',
        'status_id'
    ];

    protected $with = ['books', 'status', 'shipping_method', 'payment_method', 'shipping_address', 'invoice_address'];

    protected $appends = ['total_price', 'total_quantity'];

    public function getTotalPriceAttribute()
    {   
        $total = 0;
        
        foreach($this->books as $book) {
            $total += $book->pivot->price;
        }

        $total += $this->shipping_method->price;

        return $total;
    }

    public function getTotalQuantityAttribute()
    {   
        $total = 0;
        foreach($this->books as $book) {
            $total += $book->pivot->quantity;
        }

       $total++;

        return $total;
    }


    public function operator() 
    {
        return $this->belongsTo('App\Models\User', 'operator_id');
    }

    public function shipping_address() 
    {
        return $this->belongsTo('App\Models\Address', 'shipping_address_id');
    }

    public function invoice_address() 
    {
        return $this->belongsTo('App\Models\Address', 'invoice_address_id');
    }
    
    public function shipping_method() 
    {
        return $this->belongsTo('App\Models\ShippingMethod', 'shipping_method_id');
    }

    public function payment_method() 
    {
        return $this->belongsTo('App\Models\PaymentMethod', 'payment_method_id');
    }

    public function status() 
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function books() 
    {
        return $this->belongsToMany('App\Models\Book')->withPivot('quantity', 'price')->withTimestamps();
    }

    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }


}
