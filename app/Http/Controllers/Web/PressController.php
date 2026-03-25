<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Milestone;
use Inertia\Inertia;

class PressController extends Controller
{
    public function __invoke()
    {
        $page = Page::where('slug', 'press')->first();

        return Inertia::render('Press', [
            'page' => $page,
            'milestones' => Milestone::sorted()->get(),
        ]);
    }
}
