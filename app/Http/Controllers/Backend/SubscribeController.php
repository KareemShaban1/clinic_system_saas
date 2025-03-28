<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    //
    public function store(Request $request)
    {
        //
        $user = auth()->user();
            
        $paymentMethod = $request->payment_method;
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
    
        $user->newSubscription('default', 'price_123456')->create($paymentMethod);
    
        return response()->json(['message' => 'Subscribed successfully!']);
    }
}
