<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Inertia\Inertia;

class SecurityController extends Controller
{
    public function __invoke()
    {
        $page = Page::where('slug', 'security')->first();

        return Inertia::render('Security', [
            'page' => $page,
        ]);
    }
}
