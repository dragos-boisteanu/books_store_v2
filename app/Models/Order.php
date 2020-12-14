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

    protected $with = ['books', 'status', 'paymentMethod', 'addresses'];

    protected $appends = ['total_price', 'total_quantity'];

    public function getTotalPriceAttribute()
    {   
        $total = 0;
        foreach($this->books as $book) {
            $total += $book->pivot->price;
        }

        return $total;
    }

    public function getTotalQuantityAttribute()
    {   
        $total = 0;
        foreach($this->books as $book) {
            $total += $book->pivot->quantity;
        }

        return $total;
    }


    public function operator() 
    {
        return $this->belongsTo('App\Model\User', 'operator_id');
    }

    public function addresses() 
    {
        return $this->belongsToMany('App\Models\Address');
    }
    
    public function deliveryMethod() 
    {
        return $this->hasOne('App\Models\DeliveryMethod', 'delivery_method_id');
    }

    public function paymentMethod() 
    {
        return $this->belongsTo('App\Models\PaymentMethod');
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
