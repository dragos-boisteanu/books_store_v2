<?php

namespace App\Http\Controllers\Web\Client;

use App\Models\Book;
use App\Models\Cart;
use App\Models\County;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function create() 
    {
        $cart = Cart::getCart();

        $books = Book::getBooksForOrder(1);

        $total = 0.00;

        foreach($books as $book) {
            $total += $book->finalPrice;
        }

        $total = number_format((float)$total, 2, '.', '');

        $addresses = Address::where('user_id', Auth::id())->get();

        $counties = County::all();

        $shippingMethods = ShippingMethod::all();
        $paymentMethods = PaymentMethod::all();

        return view('client.orders.create', ['cartId'=>$cart->id, 'books'=>$books, 'addresses' => $addresses, 'counties' => $counties, 'total'=>$total, 'shippingMethods'=>$shippingMethods, 'paymentMethods'=>$paymentMethods]);
    

    }
    
    public function show() 
    {

    }

    public function update()
    {
        
    }

    public function destroy() 
    {
        
    }
}
