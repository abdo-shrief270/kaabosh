<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChangelogEntry;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChangelogController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->input('perPage', 20), 50);

        $query = ChangelogEntry::with('product')
            ->orderByDesc('release_date');

        if ($request->filled('product')) {
            $product = Product::where('slug', $request->input('product'))->first();
            if ($product) {
                $query->where('product_id', $product->id);
            }
        }

        if ($request->filled('category')) {
            $query->byCategory($request->input('category'));
        }

        $entries = $query->paginate($perPage);

        return response()->json([
            'entries' => $entries->items(),
            'pagination' => [
                'currentPage' => $entries->currentPage(),
                'lastPage' => $entries->lastPage(),
                'perPage' => $entries->perPage(),
                'total' => $entries->total(),
            ],
        ]);
    }
}
