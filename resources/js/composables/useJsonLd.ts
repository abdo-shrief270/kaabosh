const CONTEXT = 'https://schema.org' as const;

export function organizationSchema(): object {
    return {
        '@context': CONTEXT,
        '@type': 'Organization',
        name: 'Kaabosh',
        url: 'https://kaabosh.com',
        logo: 'https://kaabosh.com/images/logo.png',
    };
}

export function softwareApplicationSchema(product: {
    name: string;
    category: string;
    description: string;
    price?: string;
}): object {
    return {
        '@context': CONTEXT,
        '@type': 'SoftwareApplication',
        name: product.name,
        applicationCategory: product.category,
        description: product.description,
        ...(product.price
            ? {
                  offers: {
                      '@type': 'Offer',
                      price: product.price,
                      priceCurrency: 'USD',
                  },
              }
            : {}),
    };
}

export function blogPostingSchema(post: {
    title: string;
    datePublished: string;
    dateModified?: string;
    authorName: string;
    image?: string;
}): object {
    return {
        '@context': CONTEXT,
        '@type': 'BlogPosting',
        headline: post.title,
        datePublished: post.datePublished,
        ...(post.dateModified ? { dateModified: post.dateModified } : {}),
        author: {
            '@type': 'Person',
            name: post.authorName,
        },
        ...(post.image ? { image: post.image } : {}),
    };
}

export function faqPageSchema(items: { question: string; answer: string }[]): object {
    return {
        '@context': CONTEXT,
        '@type': 'FAQPage',
        mainEntity: items.map((item) => ({
            '@type': 'Question',
            name: item.question,
            acceptedAnswer: {
                '@type': 'Answer',
                text: item.answer,
            },
        })),
    };
}

export function jobPostingSchema(job: {
    title: string;
    description: string;
    datePosted: string;
    validThrough?: string;
    employmentType: string;
    location?: string;
}): object {
    return {
        '@context': CONTEXT,
        '@type': 'JobPosting',
        title: job.title,
        description: job.description,
        datePosted: job.datePosted,
        ...(job.validThrough ? { validThrough: job.validThrough } : {}),
        employmentType: job.employmentType,
        ...(job.location
            ? {
                  jobLocation: {
                      '@type': 'Place',
                      address: job.location,
                  },
              }
            : {}),
    };
}

export function breadcrumbSchema(items: { name: string; url: string }[]): object {
    return {
        '@context': CONTEXT,
        '@type': 'BreadcrumbList',
        itemListElement: items.map((item, index) => ({
            '@type': 'ListItem',
            position: index + 1,
            name: item.name,
            item: item.url,
        })),
    };
}
