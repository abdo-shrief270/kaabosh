<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import BlogPostCard from '@/components/website/BlogPostCard.vue';
import { Button } from '@/components/ui/button';
import { Head } from '@inertiajs/vue3';
import { FileText, ChevronLeft, ChevronRight } from 'lucide-vue-next';
import { ref, computed } from 'vue';
import { useLocale } from '@/composables/useLocale';

const { t } = useLocale();

const categories = ['All', 'Product Updates', 'Tutorials', 'Company News', 'Industry Insights'];
const activeCategory = ref('All');
const currentPage = ref(1);
const postsPerPage = 6;

const posts = [
    {
        title: 'Introducing Kaabosh CRM 2.0: A Complete Redesign',
        excerpt: 'We have rebuilt our CRM from the ground up with a focus on speed, simplicity, and powerful automation workflows that save your team hours every week.',
        author: { name: 'Sarah Chen', photo: '/images/team/member-2.jpg' },
        publishedAt: 'Mar 15, 2026',
        category: 'Product Updates',
        readingTime: '5 min read',
        slug: 'introducing-kaabosh-crm-2',
        featuredImage: '/images/blog/crm-2-launch.jpg',
    },
    {
        title: 'How to Build a Sales Pipeline That Actually Converts',
        excerpt: 'Learn the step-by-step process our top customers use to design pipelines that move deals forward and eliminate bottlenecks in their sales cycle.',
        author: { name: 'Ahmed Khalil', photo: '/images/team/member-1.jpg' },
        publishedAt: 'Mar 10, 2026',
        category: 'Tutorials',
        readingTime: '8 min read',
        slug: 'build-sales-pipeline-that-converts',
        featuredImage: '/images/blog/sales-pipeline.jpg',
    },
    {
        title: 'Kaabosh Raises Series A to Accelerate Growth',
        excerpt: 'We are thrilled to announce our Series A funding round, which will help us expand our product suite and grow our team across three continents.',
        author: { name: 'Carlos Rivera', photo: '/images/team/member-3.jpg' },
        publishedAt: 'Mar 5, 2026',
        category: 'Company News',
        readingTime: '3 min read',
        slug: 'kaabosh-series-a-funding',
        featuredImage: '/images/blog/series-a.jpg',
    },
    {
        title: 'The Future of CRM: AI-Powered Customer Relationships',
        excerpt: 'Artificial intelligence is transforming how businesses manage customer relationships. Here is what the next five years look like for the CRM industry.',
        author: { name: 'Priya Sharma', photo: '/images/team/member-6.jpg' },
        publishedAt: 'Feb 28, 2026',
        category: 'Industry Insights',
        readingTime: '6 min read',
        slug: 'future-of-crm-ai-powered',
        featuredImage: '/images/blog/ai-crm.jpg',
    },
    {
        title: 'Getting Started with Kaabosh Analytics: A Beginner Guide',
        excerpt: 'Set up your first dashboard, track key metrics, and start making data-driven decisions in under 30 minutes with our analytics platform.',
        author: { name: 'David Park', photo: '/images/team/member-5.jpg' },
        publishedAt: 'Feb 20, 2026',
        category: 'Tutorials',
        readingTime: '10 min read',
        slug: 'getting-started-kaabosh-analytics',
        featuredImage: '/images/blog/analytics-guide.jpg',
    },
    {
        title: 'New Integration: Connect Kaabosh with Slack and Teams',
        excerpt: 'Stay on top of your deals and support tickets without leaving your favorite messaging app. Our new integrations bring Kaabosh right to your workflow.',
        author: { name: 'Fatima Al-Rashid', photo: '/images/team/member-4.jpg' },
        publishedAt: 'Feb 15, 2026',
        category: 'Product Updates',
        readingTime: '4 min read',
        slug: 'slack-teams-integration',
        featuredImage: '/images/blog/integrations.jpg',
    },
    {
        title: 'Why Small Businesses Are Switching to All-in-One Platforms',
        excerpt: 'The days of juggling ten different SaaS tools are over. We explore the trend toward unified business platforms and what it means for SMBs.',
        author: { name: 'James Mitchell', photo: '/images/team/member-7.jpg' },
        publishedAt: 'Feb 8, 2026',
        category: 'Industry Insights',
        readingTime: '7 min read',
        slug: 'small-businesses-all-in-one-platforms',
        featuredImage: '/images/blog/all-in-one.jpg',
    },
    {
        title: 'Kaabosh Helpdesk Beta: What We Learned from Early Adopters',
        excerpt: 'After three months in beta, our helpdesk product has evolved significantly thanks to feedback from over 500 teams. Here is what changed and why.',
        author: { name: 'Lisa Wong', photo: '/images/team/member-8.jpg' },
        publishedAt: 'Feb 1, 2026',
        category: 'Company News',
        readingTime: '5 min read',
        slug: 'helpdesk-beta-learnings',
        featuredImage: '/images/blog/helpdesk-beta.jpg',
    },
];

const filteredPosts = computed(() => {
    if (activeCategory.value === 'All') return posts;
    return posts.filter(post => post.category === activeCategory.value);
});

const totalPages = computed(() => Math.ceil(filteredPosts.value.length / postsPerPage));

const paginatedPosts = computed(() => {
    const start = (currentPage.value - 1) * postsPerPage;
    return filteredPosts.value.slice(start, start + postsPerPage);
});

const pageNumbers = computed(() => {
    const pages: number[] = [];
    for (let i = 1; i <= totalPages.value; i++) {
        pages.push(i);
    }
    return pages;
});

function setCategory(category: string) {
    activeCategory.value = category;
    currentPage.value = 1;
}

function goToPage(page: number) {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}
</script>

<template>
    <Head title="Blog">
        <meta name="description" content="Insights, tutorials, and updates from the Kaabosh team." />
    </Head>

    <DefaultLayout>
        <!-- Page Header -->
        <section class="relative overflow-hidden bg-muted/30 py-16 lg:py-24">
            <div class="orb orb-1 -top-48 -right-32" aria-hidden="true" />
            <div class="orb orb-2 -bottom-32 -left-48" aria-hidden="true" />
            <div class="absolute inset-0 bg-mesh-gradient" aria-hidden="true" />
            <div class="absolute inset-0 bg-dot-grid" aria-hidden="true" />
            <div class="relative mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Blog</h1>
                <p class="mx-auto mt-4 max-w-2xl text-lg text-muted-foreground">
                    Insights, tutorials, and updates from the Kaabosh team.
                </p>
            </div>
        </section>

        <!-- Category Filter Tabs -->
        <section class="sticky top-16 z-30 border-b bg-background">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex gap-1 overflow-x-auto py-2">
                    <button
                        v-for="category in categories"
                        :key="category"
                        class="whitespace-nowrap rounded-lg px-4 py-2 text-sm font-medium transition-colors"
                        :class="activeCategory === category
                            ? 'bg-primary text-primary-foreground'
                            : 'text-muted-foreground hover:bg-muted hover:text-foreground'"
                        @click="setCategory(category)"
                    >
                        {{ category }}
                    </button>
                </div>
            </div>
        </section>

        <!-- Blog Posts Grid -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- Posts Grid -->
                <div v-if="paginatedPosts.length" class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <BlogPostCard
                        v-for="post in paginatedPosts"
                        :key="post.slug"
                        :post="post"
                    />
                </div>

                <!-- Empty State -->
                <div v-else class="py-20 text-center">
                    <div class="mx-auto mb-4 flex size-16 items-center justify-center rounded-full bg-muted">
                        <FileText class="size-8 text-muted-foreground" />
                    </div>
                    <p class="text-lg font-medium">No posts found</p>
                    <p class="mt-2 text-muted-foreground">There are no posts in this category yet.</p>
                    <Button variant="outline" class="mt-6" @click="setCategory('All')">
                        View all posts
                    </Button>
                </div>

                <!-- Pagination -->
                <nav v-if="totalPages > 1" class="mt-12 flex items-center justify-center gap-2" aria-label="Pagination">
                    <Button
                        variant="outline"
                        size="sm"
                        :disabled="currentPage === 1"
                        @click="goToPage(currentPage - 1)"
                    >
                        <ChevronLeft class="me-1 size-4" />
                        Previous
                    </Button>
                    <button
                        v-for="page in pageNumbers"
                        :key="page"
                        class="flex size-9 items-center justify-center rounded-lg text-sm font-medium transition-colors"
                        :class="currentPage === page
                            ? 'bg-primary text-primary-foreground'
                            : 'text-muted-foreground hover:bg-muted hover:text-foreground'"
                        @click="goToPage(page)"
                    >
                        {{ page }}
                    </button>
                    <Button
                        variant="outline"
                        size="sm"
                        :disabled="currentPage === totalPages"
                        @click="goToPage(currentPage + 1)"
                    >
                        Next
                        <ChevronRight class="ms-1 size-4" />
                    </Button>
                </nav>
            </div>
        </section>
    </DefaultLayout>
</template>
