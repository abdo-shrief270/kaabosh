<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreContactRequest;
use App\Http\Requests\Api\StoreSalesContactRequest;
use App\Models\ContactSubmission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function general(StoreContactRequest $request): JsonResponse
    {
        ContactSubmission::create([
            'type' => 'general',
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'subject' => $request->validated('subject'),
            'message' => $request->validated('message'),
            'status' => 'new',
        ]);

        return response()->json([
            'message' => 'Your message has been received. We will get back to you soon.',
        ], 201);
    }

    public function sales(StoreSalesContactRequest $request): JsonResponse
    {
        ContactSubmission::create([
            'type' => 'sales',
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'company' => $request->validated('company'),
            'team_size' => $request->validated('teamSize'),
            'product_interest' => $request->validated('productInterest'),
            'message' => $request->validated('message'),
            'status' => 'new',
        ]);

        return response()->json([
            'message' => 'Your sales inquiry has been received. Our team will reach out shortly.',
        ], 201);
    }

    public function chatOffline(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:5', 'max:2000'],
        ]);

        ContactSubmission::create([
            'type' => 'chat_offline',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        return response()->json([
            'message' => 'Your message has been received. We will respond via email.',
        ], 201);
    }
}
