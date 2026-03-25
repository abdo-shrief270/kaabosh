<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCareerInterestRequest;
use App\Http\Requests\Api\StoreJobApplicationRequest;
use App\Models\CompanyValue;
use App\Models\ContactSubmission;
use App\Models\JobApplication;
use App\Models\JobRole;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = JobRole::active()->notExpired()->orderBy('posted_at', 'desc');

        if ($request->filled('department')) {
            $query->byDepartment($request->input('department'));
        }

        $roles = $query->get();

        // Group roles by department
        $departments = $roles->groupBy('department')->map(fn ($group) => $group->values());

        return response()->json([
            'roles' => $roles,
            'departments' => $departments,
            'culture' => [
                'values' => CompanyValue::sorted()->get(),
                'perks' => [
                    'Remote-first culture',
                    'Competitive salary & equity',
                    'Generous PTO',
                    'Learning & development budget',
                    'Health & wellness benefits',
                    'Home office stipend',
                ],
            ],
        ]);
    }

    public function show(JobRole $jobRole): JsonResponse
    {
        return response()->json([
            'role' => $jobRole,
        ]);
    }

    public function interest(StoreCareerInterestRequest $request): JsonResponse
    {
        ContactSubmission::create([
            'type' => 'career_interest',
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'subject' => $request->validated('area'),
            'message' => $request->validated('message'),
            'status' => 'new',
        ]);

        return response()->json([
            'message' => 'Your interest has been recorded. We will reach out when relevant positions open.',
        ], 201);
    }

    public function apply(StoreJobApplicationRequest $request, JobRole $jobRole): JsonResponse
    {
        $cvPath = null;
        if ($request->hasFile('cvFile')) {
            $cvPath = $request->file('cvFile')->store('applications/cvs', 'private');
        }

        $application = JobApplication::create([
            'job_role_id' => $jobRole->id,
            'full_name' => $request->validated('fullName'),
            'email' => $request->validated('email'),
            'phone' => $request->validated('phone'),
            'country' => $request->validated('country'),
            'cv_path' => $cvPath,
            'linkedin_url' => $request->validated('linkedinUrl'),
            'portfolio_url' => $request->validated('portfolioUrl'),
            'cover_letter' => $request->validated('coverLetter'),
            'referral_source' => $request->validated('referralSource'),
            'referral_name' => $request->validated('referralName'),
            'diversity_gender' => $request->validated('diversityGender'),
            'diversity_ethnicity' => $request->validated('diversityEthnicity'),
            'diversity_disability' => $request->validated('diversityDisability'),
            'status' => 'new',
            'reference_number' => 'APP-' . strtoupper(Str::random(8)),
        ]);

        return response()->json([
            'message' => 'Your application has been submitted successfully.',
            'referenceNumber' => $application->reference_number,
        ], 201);
    }
}
