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
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->simplePaginate(15);

        $shippingMethods = ShippingMethod::all();
        $paymentMethods = PaymentMethod::all();

        $statuses = Status::all();

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
        $order = Order::findOrFail($id);

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
        $order = Order::findOrFail($id);

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

        return redirect()->route('admin-orders.show', ['order'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
