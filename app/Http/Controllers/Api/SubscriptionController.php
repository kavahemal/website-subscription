<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriberResource;
use App\Models\Subscriber;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::withCount('subscriptions')
            ->with(['subscriptions.website'])
            ->latest()
            ->get();

        return SubscriberResource::collection($subscribers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
            'name' => 'nullable|string|max:255',
            'website_id' => 'required|exists:websites,id',
        ]);

        $subscriber = Subscriber::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name]
        );

        Subscription::firstOrCreate(
            ['subscriber_id' => $subscriber->id, 'website_id' => $request->website_id],
            []
        );

        return response()->json(['message' => 'Subscribed successfully'], 201);
    }
}
