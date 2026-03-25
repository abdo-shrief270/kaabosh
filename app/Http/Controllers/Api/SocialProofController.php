<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\TrustLogo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SocialProofController extends Controller
{
    public function logos(Request $request): JsonResponse
    {
        $query = TrustLogo::active()->sorted();

        if ($request->filled('context')) {
            $query->forContext($request->input('context'));
        }

        return response()->json([
            'logos' => $query->get(),
        ]);
    }

    public function testimonials(Request $request): JsonResponse
    {
        $query = Testimonial::active()->sorted();

        if ($request->filled('page')) {
            $query->forPage($request->input('page'));
        }

        if ($request->filled('product')) {
            $query->where('product_used', $request->input('product'));
        }

        return response()->json([
            'testimonials' => $query->get(),
        ]);
    }
}
