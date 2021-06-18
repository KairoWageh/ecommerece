<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Plan;

class SubscriptionController extends Controller
{
    public function create(Request $request, Plan $plan)
    {
        $plan = Plan::findOrFail($request->get('plan'));

        //return $plan;
        
        $request->user()
            ->newSubscription('main', $plan->stripe_plan)
            ->create($request->stripeToken, [ ]);
        
        return redirect()->route('home')->with('success', 'Your plan subscribed successfully');
    }
}
