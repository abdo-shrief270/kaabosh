<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\JobRole;
use App\Models\CompanyValue;
use Inertia\Inertia;

class CareerController extends Controller
{
    public function index()
    {
        return Inertia::render('Careers/Index', [
            'roles' => JobRole::active()->notExpired()->latest('posted_at')->get(),
            'departments' => JobRole::active()->notExpired()->distinct()->pluck('department')->filter()->values(),
            'culture' => CompanyValue::sorted()->get(),
        ]);
    }

    public function show(JobRole $jobRole)
    {
        $relatedRoles = JobRole::active()
            ->notExpired()
            ->where('id', '!=', $jobRole->id)
            ->where('department', $jobRole->department)
            ->latest('posted_at')
            ->take(3)
            ->get();

        return Inertia::render('Careers/Show', [
            'role' => $jobRole,
            'relatedRoles' => $relatedRoles,
        ]);
    }
}
