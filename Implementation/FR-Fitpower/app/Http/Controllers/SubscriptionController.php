<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::all();
        foreach ($subscriptions as $subscription) {
            $subscription->includes = explode(',', $subscription->includes);
        }
        return view('subscription.index',[
            'subscriptions' => $subscriptions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'includes' => 'required',
        ]);

        Subscription::create($validatedData);

        return redirect()->route('Admin - Subscriptions')->with('success', 'Subscription added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        return view('subscription.edit',[
            'subscription' => $subscription,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'includes' => 'required',
        ]);

        $subscription->update($validatedData);

        return redirect()->route('Admin - Subscriptions')->with('success', 'Subscription added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('Admin - Subscriptions')->with('success', 'Subscriptions deleted');
    }
}
