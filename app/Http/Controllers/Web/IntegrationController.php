<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Integration;
use Inertia\Inertia;

class IntegrationController extends Controller
{
    public function index()
    {
        return Inertia::render('Integrations/Index', [
            'integrations' => Integration::active()->sorted()->get(),
            'categories' => Integration::active()->distinct()->pluck('category')->filter()->values(),
        ]);
    }

    public function show(Integration $integration)
    {
        return Inertia::render('Integrations/Show', [
            'integration' => $integration,
        ]);
    }
}
