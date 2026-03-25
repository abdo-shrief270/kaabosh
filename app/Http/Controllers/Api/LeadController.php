<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreLeadRequest;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;

class LeadController extends Controller
{
    public function waitlist(StoreLeadRequest $request): JsonResponse
    {
        $existing = Lead::where('email', $request->validated('email'))
            ->where('source', 'waitlist')
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'You are already on the waitlist.',
            ]);
        }

        Lead::create([
            'email' => $request->validated('email'),
            'first_name' => $request->validated('firstName'),
            'product_interest' => $request->validated('productInterest'),
            'source' => 'waitlist',
            'locale' => $request->header('Accept-Language', 'en'),
        ]);

        return response()->json([
            'message' => 'You have been added to the waitlist.',
        ], 201);
    }

    public function changelogSubscribe(StoreLeadRequest $request): JsonResponse
    {
        $existing = Lead::where('email', $request->validated('email'))
            ->where('source', 'changelog')
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'You are already subscribed to changelog updates.',
            ]);
        }

        Lead::create([
            'email' => $request->validated('email'),
            'first_name' => $request->validated('firstName'),
            'product_interest' => $request->validated('productInterest'),
            'source' => 'changelog',
            'locale' => $request->header('Accept-Language', 'en'),
        ]);

        return response()->json([
            'message' => 'You have been subscribed to changelog updates.',
        ], 201);
    }
}
