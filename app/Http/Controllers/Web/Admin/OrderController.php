<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $orders = Order::where( function ($query) use ($request) {
            if( ($id = $request->id) ) {
                $query->where('id', $id);
            }

            if( ($client = $request->client) ) {
                $query->whereHas('user', function($query) use ($client) {
                    $query->where('id', $client);
                });
            }

            if( ($status = $request->status) ) {
                $query->whereHas('status', function($query) use ($status) {
                    $query->where('id', $status);
                });
            }

            if ( ($avaiable = $request->avaiable) ) {
                if($avaiable == 2) {
                    $query->whereNull('deleted_at');
                } else {
                    $query->whereNotNull('deleted_at');
                }
            }

            if ( ($shippingMethod = $request->shipping_method) ) {
                $query->where('shipping_method_id', $shippingMethod);
            }

            if( ( $paymentMethod = $request->payment_method) ) {
                $query->where('payment_method_id', $paymentMethod);
            }

        })->withTrashed()->orderBy('created_at', 'desc')->simplePaginate(15);;



        $shippingMethods = ShippingMethod::all();
        $paymentMethods = PaymentMethod::all();
        $statuses = Status::all();

        $request->flash();
            
        return view('admin.orders.index', ['orders'=>$orders,                       
                                            'shipping_methods'=>$shippingMethods, 
                                            'payment_methods'=>$paymentMethods,
                                            'statuses'=>$statuses
                                        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::withTrashed()->findOrFail($id);

        $shippingMethods = ShippingMethod::all();
        $paymentMethods = PaymentMethod::all();

        $statuses = Status::all();

        $userAddresses = $order->user->addresses;

        return view('admin.orders.show', ['order'=>$order,
                                            'shipping_methods'=>$shippingMethods, 
                                            'payment_methods'=>$paymentMethods,
                                            'statuses'=>$statuses,
                                            'user_addresses'=>$userAddresses
                                        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::withTrashed()->findOrFail($id);

        $shippingMethods = ShippingMethod::all();
        $paymentMethods = PaymentMethod::all();

        $statuses = Status::all();

        $userAddresses = $order->user->addresses;

        $operators = User::where('role_id', 2)->orWhere('role_id', 3)->get();

        return view('admin.orders.edit', ['order'=>$order,
                                            'shipping_methods'=>$shippingMethods, 
                                            'payment_methods'=>$paymentMethods,
                                            'statuses'=>$statuses,
                                            'user_addresses'=>$userAddresses,
                                            'operators'=>$operators
                                        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $input = $request->all();

        $input['updated_by'] = Auth::id();

        Order::findOrFail($id)->update($input);

        return redirect()->route('admin-orders.edit', ['order'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();

        return redirect()->route('admin-orders.index');
    }
}
