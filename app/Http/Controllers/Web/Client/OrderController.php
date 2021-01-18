<?php

namespace App\Http\Controllers\Web\Client;

use Exception;
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

    public function index(Request $request) 
    {
        $orders = Order::where( function($query) use ($request) {

            if( ($id = $request->id) ) {
                $query->where('id', $id);
            }
            $query->where('user_id', Auth::id());

        })->orderBy('created_at', 'desc')->paginate(5)->withQueryString();


        $request->flash();
        
        return view('client.orders.index', ['orders'=>$orders]);

    }

    public function create() 
    {
        $cart = Cart::getCart();

        if(count($cart->books) === 0) {
            return back();
        }

        $books = Book::getBooksForOrder($cart->id);

        $total = 0.00;

        foreach($books as $book) {
            $total += $book->finalPrice;
        }

        $total = number_format((float)$total, 2, '.', '');

        $addresses = Address::where('user_id', Auth::id())->get();

        $counties = County::all();

        $shippingMethods = ShippingMethod::all();
        $paymentMethods = PaymentMethod::all();

        return view('client.orders.create', ['cartId'=>$cart->id, 'books'=>$books, 'addresses'=>$addresses, 
                                                'counties' => $counties, 'total'=>$total, 'shippingMethods'=>$shippingMethods, 
                                                'paymentMethods'=>$paymentMethods]);

    }
    
    public function store(Request $request)
    {
        $input = $request->all();

        $input['user_id'] = Auth::id();

        DB::beginTransaction();

        try{

            $cart = Cart::getCart();

            if(count($cart->books) === 0) {
                throw new Exception();
            }
            
            $order = new Order();

            $order->user_id = $input['user_id'];

            $order->payment_method_id = $input['paymentMethod'];
            $order->shipping_method_id = $input['shippingMethod'];

            $order->status_id = '1';
            $order->operator_id = '2';

            if($request->has('shipping_address')) {
                $order->shipping_address_id = $request['shipping_address'];
            } else {
                $shippingAddress = Address::create($input);
                $shippingAddress->refresh();
                $order->shipping_address_id = $shippingAddress->id;
            }


            if(!isset($input['useAsInvoice'])) {
                if($request->has('invoice_address')) {
                    $order->invoice_address_id = $request['invoice_address'];
                } else {
                    dump('new invoice address');
                    $invoiceAddress = new Address();

                    $invoiceAddress->user_id =  $input['user_id'];

                    $invoiceAddress->first_name = $input['i_first_name'];
                    $invoiceAddress->name = $input['i_name'];

                    $invoiceAddress->phone_number = $input['i_phone_number'];
                    $invoiceAddress->county_id = $input['i_county_id'];
                    $invoiceAddress->city_id = $input['i_city_id'];
                    $invoiceAddress->address = $input['i_address'];
                    // $invoiceAddress->postal_code = 'i_00000';
                    
                    $invoiceAddress->save();    
                    $invoiceAddress->fresh();
                
                    $order->invoice_address_id = $invoiceAddress->id;
                }
            }else {
                if($request->has('shipping_address')) {
                    $order->invoice_address_id = $request['shipping_address'];
                } else {
                    $order->invoice_address_id = $shippingAddress->id;
                }
                
            }

            $order->save();
            $order->refresh();

            foreach($cart->books as $book) {
 
                if($book->stock->quantity > 0 && $book->stock->quantity >= $book->pivot->quantity) {
                    $order->books()->attach($book->id, ['quantity'=>$book->pivot->quantity, 'price'=>$book->price]);
                    $book->stock->quantity = $book->stock->quantity - $book->pivot->quantity;
                    $book->stock->save();
                    $cart->books()->detach($book->id);
                }else {
                    throw new Exception('Book ' . $book->title . ' is not in stock. Order placement canceled');
                }
            }

     
            $order->books()->syncWithoutDetaching($cart->books);

            DB::commit();

            return redirect()->route('client-orders.index');

        }catch(Exception $ex) {

            dd($ex);

            DB::rollback();

            return back();
        }

    }

    public function show($id) 
    {
        $order = Order::findOrFail($id);

        return view('client.orders.show', ['order'=>$order]);
    }

    public function update()
    {
        
    }

    public function destroy() 
    {
        
    }
}
