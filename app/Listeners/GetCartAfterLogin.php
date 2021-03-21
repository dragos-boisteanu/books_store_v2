<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Events\Login;
use App\Events\UserLoggedIn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetCartAfterLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle()
    {
        $cartId = session()->get('cartId');
        
        $sessionCart = Cart::findOrFail($cartId);

        $cart = Cart::where('user_id', auth()->id())->first();

        if( isset($cart) && (isset($sessionCart))) {
            foreach($sessionCart->books as $book) {
                $cart->addItem($book->id);
            }
            $sessionCart->delete();
        } else {
            if(isset($sessionCart)) {
                $sessionCart->user_id = auth()->id();
                $sessionCart->session_id = null; 
                $sessionCart->save();
            } else {
                $cart = Cart::create([
                    'user_id' => auth()->id(),
                ]);
            }
        }

        session()->forget('cartId');            
    }

}
