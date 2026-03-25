<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Models\CompanyValue;
use App\Models\Milestone;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('About', [
            'team' => TeamMember::active()->sorted()->get(),
            'values' => CompanyValue::sorted()->get(),
            'milestones' => Milestone::sorted()->get(),
        ]);
    }
}
