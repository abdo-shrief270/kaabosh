import { onMounted, onUnmounted } from 'vue';

interface ConsentPreferences {
    necessary: boolean;
    analytics: boolean;
    marketing: boolean;
}

/**
 * Parse the consent_preferences cookie.
 * Returns null if the cookie is missing or malformed.
 */
function getCookieConsent(): ConsentPreferences | null {
    const match = document.cookie
        .split('; ')
        .find((row) => row.startsWith('consent_preferences='));

    if (!match) return null;

    try {
        return JSON.parse(decodeURIComponent(match.split('=').slice(1).join('=')));
    } catch {
        return null;
    }
}

/**
 * Generic event tracking function.
 * Only fires if the user has granted analytics consent.
 */
function track(event: string, properties: Record<string, unknown> = {}): void {
    const consent = getCookieConsent();
    if (!consent?.analytics) return;

    if (import.meta.env.DEV) {
        console.debug(`[Analytics] ${event}`, properties);
    }

    // Dispatch a CustomEvent so that any analytics SDK adapter can listen and forward.
    window.dispatchEvent(
        new CustomEvent('analytics', {
            detail: { event, properties },
        }),
    );
}

// ---------------------------------------------------------------------------
// 14.1 Page View Events
// ---------------------------------------------------------------------------

export function trackPageView(path: string, title: string, locale: string, referrer?: string): void {
    track('page_view', { path, title, locale, referrer: referrer ?? document.referrer });
}

// ---------------------------------------------------------------------------
// 14.2 CTA Click Events
// ---------------------------------------------------------------------------

export type CtaPosition = 'hero' | 'nav' | 'pricing' | 'final_cta' | 'product_card';

export function trackCtaClick(
    label: string,
    destination: string,
    page: string,
    position: CtaPosition,
    product?: string,
): void {
    track('cta_click', { label, destination, page, position, ...(product && { product }) });
}

// ---------------------------------------------------------------------------
// 14.3 Form Events
// ---------------------------------------------------------------------------

export type FormId =
    | 'waitlist'
    | 'contact'
    | 'contact_sales'
    | 'job_application'
    | 'careers_interest'
    | 'changelog_subscribe';

export function trackFormStart(formId: FormId, page: string, product?: string): void {
    track('form_start', { formId, page, ...(product && { product }) });
}

export function trackFormSubmit(formId: FormId, page: string, product?: string): void {
    track('form_submit', { formId, page, ...(product && { product }) });
}

export function trackFormError(formId: FormId, page: string, errorType: string, product?: string): void {
    track('form_error', { formId, page, errorType, ...(product && { product }) });
}

// ---------------------------------------------------------------------------
// 14.4 Scroll Depth Events
// ---------------------------------------------------------------------------

export function trackScrollDepth(depthPercent: number, page: string, product?: string): void {
    track('scroll_depth', { depth_percent: depthPercent, page, ...(product && { product }) });
}

// ---------------------------------------------------------------------------
// 14.5 Video Events
// ---------------------------------------------------------------------------

export function trackVideoPlay(product: string, videoUrl: string): void {
    track('video_play', { product, videoUrl });
}

export function trackVideoProgress(product: string, videoUrl: string, percent: number): void {
    track('video_progress', { product, videoUrl, percent });
}

export function trackVideoComplete(product: string, videoUrl: string): void {
    track('video_complete', { product, videoUrl });
}

// ---------------------------------------------------------------------------
// 14.6 Search Events
// ---------------------------------------------------------------------------

export function trackSearchQuery(query: string, resultsCount: number): void {
    track('search_query', { query, resultsCount });
}

export function trackSearchResultClick(query: string, selectedTitle: string, selectedType: string): void {
    track('search_result_click', { query, selectedTitle, selectedType });
}

// ---------------------------------------------------------------------------
// 14.7 Outbound Link Events
// ---------------------------------------------------------------------------

export function trackOutboundClick(destination: string, label: string, page: string): void {
    track('outbound_click', { destination, label, page });
}

// ---------------------------------------------------------------------------
// Composable: Scroll depth tracking (25 / 50 / 75 / 100 %)
// ---------------------------------------------------------------------------

export function useScrollDepthTracking(page: string, product?: string): void {
    const thresholds = [25, 50, 75, 100] as const;
    const reached = new Set<number>();

    function handleScroll(): void {
        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
        if (scrollHeight <= 0) return;

        const percent = Math.round((window.scrollY / scrollHeight) * 100);

        for (const threshold of thresholds) {
            if (percent >= threshold && !reached.has(threshold)) {
                reached.add(threshold);
                trackScrollDepth(threshold, page, product);
            }
        }
    }

    onMounted(() => {
        window.addEventListener('scroll', handleScroll, { passive: true });
    });

    onUnmounted(() => {
        window.removeEventListener('scroll', handleScroll);
    });
}

// ---------------------------------------------------------------------------
// Composable: Outbound link tracking
// ---------------------------------------------------------------------------

export function useOutboundLinkTracking(page: string): void {
    const controller = new AbortController();

    function isExternal(url: string): boolean {
        try {
            return new URL(url, window.location.origin).hostname !== window.location.hostname;
        } catch {
            return false;
        }
    }

    function handleClick(event: MouseEvent): void {
        const anchor = (event.target as HTMLElement).closest('a');
        if (!anchor) return;

        const href = anchor.getAttribute('href');
        if (!href || !isExternal(href)) return;

        trackOutboundClick(href, anchor.textContent?.trim() ?? '', page);
    }

    onMounted(() => {
        document.addEventListener('click', handleClick, { signal: controller.signal });
    });

    onUnmounted(() => {
        controller.abort();
    });
}
