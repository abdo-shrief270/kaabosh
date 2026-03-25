<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnnouncementBar;
use App\Models\CompanyValue;
use App\Models\Milestone;
use App\Models\Page;
use App\Models\Product;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function announcementBar(): JsonResponse
    {
        $bar = AnnouncementBar::where('is_active', true)->latest()->first();

        if (!$bar) {
            return response()->json(['isActive' => false]);
        }

        return response()->json([
            'isActive' => true,
            'message' => $bar->message,
            'ctaLabel' => $bar->cta_label,
            'ctaUrl' => $bar->cta_url,
            'bgColor' => $bar->bg_color,
            'textColor' => $bar->text_color,
        ]);
    }

    public function navigation(): JsonResponse
    {
        $products = Product::sorted()->get(['slug', 'name', 'tagline', 'logo', 'status']);

        return response()->json([
            'products' => $products,
            'footerLinks' => [
                'products' => $products->map(fn ($p) => ['label' => $p->name, 'href' => "/products/{$p->slug}"]),
                'company' => [
                    ['label' => 'About', 'href' => '/about'],
                    ['label' => 'Blog', 'href' => '/blog'],
                    ['label' => 'Careers', 'href' => '/careers'],
                    ['label' => 'Press', 'href' => '/press'],
                    ['label' => 'Contact', 'href' => '/contact'],
                ],
                'legal' => [
                    ['label' => 'Privacy Policy', 'href' => '/privacy-policy'],
                    ['label' => 'Terms of Service', 'href' => '/terms-of-service'],
                    ['label' => 'Cookie Policy', 'href' => '/cookie-policy'],
                ],
            ],
        ]);
    }

    public function homepage(): JsonResponse
    {
        return response()->json([
            'hero' => [
                'headline' => config('app.name', 'Kaabosh') . ' — Modern tools for modern teams',
                'subheadline' => 'A suite of powerful SaaS products designed to help your team sell smarter, support faster, and grow sustainably.',
                'primaryCtaLabel' => 'Get Started',
                'primaryCtaUrl' => '/products',
                'secondaryCtaLabel' => 'View Products',
                'secondaryCtaUrl' => '/products',
            ],
            'stats' => [
                ['value' => '10,000+', 'label' => 'Teams'],
                ['value' => '99.9%', 'label' => 'Uptime'],
                ['value' => '2M+', 'label' => 'API Calls / Day'],
                ['value' => '4.9/5', 'label' => 'Rating'],
            ],
            'whyChooseUs' => CompanyValue::sorted()->get(),
            'waitlistConfig' => [
                'headline' => 'Stay in the Loop',
                'description' => 'Get product updates and early access.',
            ],
        ]);
    }

    public function about(Request $request): JsonResponse
    {
        return response()->json([
            'team' => TeamMember::active()->sorted()->get(),
            'values' => CompanyValue::sorted()->get(),
            'milestones' => Milestone::sorted()->get(),
        ]);
    }

    public function security(Request $request): JsonResponse
    {
        $locale = $request->header('Accept-Language', 'en');
        $page = Page::where('slug', 'security')->where('locale', $locale)->first();

        return response()->json([
            'content' => $page,
        ]);
    }

    public function useCase(string $audience, Request $request): JsonResponse
    {
        $locale = $request->header('Accept-Language', 'en');
        $page = Page::where('slug', "for-{$audience}")->where('locale', $locale)->first();
        $products = Product::live()->get();
        $testimonial = Testimonial::forPage($audience)->active()->first();

        return response()->json([
            'page' => $page,
            'productsSubset' => $products,
            'testimonial' => $testimonial,
        ]);
    }

    public function legal(string $type, Request $request): JsonResponse
    {
        $locale = $request->header('Accept-Language', 'en');
        $page = Page::where('slug', $type)
            ->where('locale', $locale)
            ->firstOrFail();

        return response()->json([
            'title' => $page->title,
            'lastUpdated' => $page->last_updated_at?->toDateString(),
            'body' => $page->body,
        ]);
    }
}
