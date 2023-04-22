<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\ClientSubscription;

class ClientSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = ClientSubscription::with(['user', 'subscription'])->get();
        foreach ($subscriptions as $subscription) {
            $subscription->date_start = DateTime::createFromFormat('Y-m-d', $subscription->date_start);
            $subscription->date_end = DateTime::createFromFormat('Y-m-d', $subscription->date_end);
        }
        return view('ClientSubscriptions.index', [
            'clientSubs' => $subscriptions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
