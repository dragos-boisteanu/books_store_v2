<?php

namespace App\Http\Controllers\Web\Client;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\County;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use Illuminate\Support\Facades\DB;
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
    
    public function store(Request $request)
    {
        $input = $request->all();

        \DB::beginTransaction();
        try{

            $cart = Cart::getCart();

            $order = new Order();

            $shippingAddress = new Address();
            $shippingAddress->user_id = Auth::id();

            $shippingAddress->first_name = $input['first_name'];
            $shippingAddress->name = $input['name'];

            $shippingAddress->phone_number = $input['phone_number'];
            $shippingAddress->county_id = $input['county'];
            $shippingAddress->city_id = $input['city'];
            $shippingAddress->address = $input['address'];
            $shippingAddress->postal_code = '00000';

            $shippingAddress->save();
            $shippingAddress->fresh();

            $order->user_id = Auth::id();

            $order->payment_method_id = $input['paymentMethod'];
            $order->status_id = '1';
            $order->shipping_method_id = $input['shippingMethod'];

            $order->save();
            $order->fresh();

            if(!$input['useAsInvoice']) {
                $invoiceAddress = new Address();

                $invoiceAddress->user_id = Auth::id();

                $invoiceAddress->first_name = $input['i_first_name'];
                $invoiceAddress->name = $input['i_name'];

                $invoiceAddress->phone_number = $input['i_phone_number'];
                $invoiceAddress->county_id = $input['i_county'];
                $invoiceAddress->city_id = $input['i_city'];
                $invoiceAddress->address = $input['i_address'];
                $invoiceAddress->postalcode = 'i_00000';
                
                $invoiceAddress->save();    
                $invoiceAddress->fresh();
               
                $order->addresses()->attach($shippingAddress->id, ['invoice_id' => $invoiceAddress->id]);
            }else {
                $order->addresses()->attach($shippingAddress->id, ['invoice_id' => $shippingAddress->id]);
            }

            
            foreach($cart->books as $book) {
                if($book->stock->quantity > 0 && $book->stock->quantity >= $book->pivot->quantity) {
                    // $book->pivot->quantity = $book->quantity;
                    // $book->pivot->price = $book->price;
                    $order->books()->attach($book->id, ['quantity'=>$book->pivot->quantity, 'price'=>$book->price]);
                    $book->stock->quantity = $book->stock->quantity-$book->pivot->quantity;
                    $book->stock->save();
                    $cart->books()->detach($book->id);
                }else {
                    throw new Exception();
                }
            }
     
            $order->books()->syncWithoutDetaching($cart->books);
           
            $result = [
                'delivery address' => $shippingAddress,
                'order' => $order,
                'books' => $cart->books
                ];

            \DB::commit();

        }catch(\Exception $ex) {

            dd($ex);

            \DB::rollback();

            return back();
        }

        return $result;
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
