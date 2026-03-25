import { computed } from 'vue';

const BASE_URL = 'https://kaabosh.com';

function truncate(text: string, maxLength: number): string {
    if (text.length <= maxLength) return text;
    return text.slice(0, maxLength - 3).trimEnd() + '...';
}

export function useSeo(params: {
    title: string;
    description: string;
    ogImage?: string;
    canonicalPath: string;
    type?: string;
}) {
    const meta = computed(() => {
        const title = truncate(params.title, 60);
        const description = truncate(params.description, 160);
        const canonicalUrl = `${BASE_URL}${params.canonicalPath}`;
        const ogType = params.type ?? 'website';

        return {
            title,
            description,
            canonicalUrl,
            og: {
                title,
                description,
                url: canonicalUrl,
                type: ogType,
                ...(params.ogImage ? { image: params.ogImage } : {}),
            },
            twitter: {
                card: 'summary_large_image' as const,
                title,
                description,
                ...(params.ogImage ? { image: params.ogImage } : {}),
            },
            hreflang: [
                { lang: 'en', href: canonicalUrl },
                { lang: 'ar', href: `${BASE_URL}/ar${params.canonicalPath}` },
                { lang: 'fr', href: `${BASE_URL}/fr${params.canonicalPath}` },
                { lang: 'x-default', href: canonicalUrl },
            ],
        };
    });

    return { meta };
}
