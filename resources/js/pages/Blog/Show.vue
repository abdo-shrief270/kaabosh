<script setup lang="ts">
import BlogLayout from '@/layouts/website/BlogLayout.vue';
import BlogPostCard from '@/components/website/BlogPostCard.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Head, Link } from '@inertiajs/vue3';
import { ArrowLeft, Linkedin, Twitter, LinkIcon, Check, Calendar, Clock } from 'lucide-vue-next';
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { useLocale } from '@/composables/useLocale';

const { t } = useLocale();

const props = defineProps<{
    slug: string;
    post?: {
        title: string; excerpt: string;
        author: { name: string; photo: string; bio: string; url: string };
        publishedAt: string; category: string; readingTime: string;
        slug: string; featuredImage: string; content: string;
    };
    relatedPosts?: Array<{
        title: string; excerpt: string; author: { name: string; photo: string };
        publishedAt: string; category: string; readingTime: string;
        slug: string; featuredImage: string;
    }>;
}>();

const copied = ref(false);
const scrollProgress = ref(0);

function updateScrollProgress() {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    scrollProgress.value = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
}

onMounted(() => {
    window.addEventListener('scroll', updateScrollProgress, { passive: true });
});

onUnmounted(() => {
    window.removeEventListener('scroll', updateScrollProgress);
});

const post = computed(() => props.post ?? ({
    title: 'Introducing Kaabosh CRM 2.0: A Complete Redesign',
    excerpt: 'We have rebuilt our CRM from the ground up with a focus on speed, simplicity, and powerful automation workflows that save your team hours every week.',
    author: {
        name: 'Sarah Chen',
        photo: '/images/team/member-2.jpg',
        bio: 'Sarah is the Head of Product at Kaabosh. She has spent over a decade building SaaS products and is passionate about creating tools that help teams work smarter.',
        url: '/about',
    },
    publishedAt: 'Mar 15, 2026',
    category: 'Product Updates',
    readingTime: '5 min read',
    slug: props.slug,
    featuredImage: '/images/blog/crm-2-launch.jpg',
    content: `
        <p>After months of research, design sprints, and customer interviews, we are excited to unveil Kaabosh CRM 2.0 — the most significant update since we launched.</p>

        <h2>Why We Rebuilt From Scratch</h2>
        <p>When we first launched Kaabosh CRM, our goal was simple: give small teams a CRM they would actually enjoy using. And for thousands of teams, it delivered on that promise. But as our customers grew, so did their needs.</p>
        <p>We heard consistent feedback about three areas: speed, customization, and automation. Rather than bolting on features to our existing architecture, we made the bold decision to rebuild the core from the ground up.</p>

        <h2>What Is New in 2.0</h2>
        <h3>Lightning-Fast Performance</h3>
        <p>Every interaction in Kaabosh CRM 2.0 is now under 100ms. We rewrote our data layer, implemented optimistic updates, and moved to edge computing for global users. The result is a CRM that feels instant, no matter where you are in the world.</p>

        <h3>Flexible Custom Fields</h3>
        <p>You can now create custom fields of any type — text, numbers, dates, dropdowns, multi-selects, and even formula fields. Organize them into groups, set validation rules, and use them across your pipelines and reports.</p>

        <h3>Workflow Automation Engine</h3>
        <p>Our new visual automation builder lets you create sophisticated workflows without writing a single line of code. Trigger actions based on deal stage changes, time delays, field updates, or external events via webhooks.</p>

        <blockquote>
            <p>"The new automation engine has saved our sales team at least 10 hours per week. We have automated follow-ups, task assignments, and even Slack notifications."</p>
            <cite>— Maria Santos, VP of Sales at TechFlow</cite>
        </blockquote>

        <h2>Migration Is Seamless</h2>
        <p>If you are already using Kaabosh CRM, your upgrade path is simple. We have built an automatic migration tool that moves your data, custom configurations, and integrations to the new platform with zero downtime.</p>

        <h2>What Is Next</h2>
        <p>This release is just the beginning. In the coming months, we will be rolling out AI-powered lead scoring, advanced reporting dashboards, and deeper integrations with the rest of the Kaabosh suite. Stay tuned to this blog for updates.</p>

        <p>Ready to try it out? <a href="/products/crm">Explore Kaabosh CRM 2.0</a> or <a href="/contact">talk to our team</a> if you have questions about upgrading.</p>
    `,
}));

const displayRelatedPosts = computed(() => props.relatedPosts ?? [
    {
        title: 'How to Build a Sales Pipeline That Actually Converts',
        excerpt: 'Learn the step-by-step process our top customers use to design pipelines that move deals forward.',
        author: { name: 'Ahmed Khalil', photo: '/images/team/member-1.jpg' },
        publishedAt: 'Mar 10, 2026',
        category: 'Tutorials',
        readingTime: '8 min read',
        slug: 'build-sales-pipeline-that-converts',
        featuredImage: '/images/blog/sales-pipeline.jpg',
    },
    {
        title: 'New Integration: Connect Kaabosh with Slack and Teams',
        excerpt: 'Stay on top of your deals and support tickets without leaving your favorite messaging app.',
        author: { name: 'Fatima Al-Rashid', photo: '/images/team/member-4.jpg' },
        publishedAt: 'Feb 15, 2026',
        category: 'Product Updates',
        readingTime: '4 min read',
        slug: 'slack-teams-integration',
        featuredImage: '/images/blog/integrations.jpg',
    },
    {
        title: 'The Future of CRM: AI-Powered Customer Relationships',
        excerpt: 'Artificial intelligence is transforming how businesses manage customer relationships.',
        author: { name: 'Priya Sharma', photo: '/images/team/member-6.jpg' },
        publishedAt: 'Feb 28, 2026',
        category: 'Industry Insights',
        readingTime: '6 min read',
        slug: 'future-of-crm-ai-powered',
        featuredImage: '/images/blog/ai-crm.jpg',
    },
]);

const currentUrl = computed(() => {
    if (typeof window !== 'undefined') {
        return window.location.href;
    }
    return `/blog/${props.slug}`;
});

function shareOnLinkedIn() {
    window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(currentUrl.value)}`, '_blank', 'noopener,noreferrer');
}

function shareOnTwitter() {
    window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(currentUrl.value)}&text=${encodeURIComponent(post.value.title)}`, '_blank', 'noopener,noreferrer');
}

function copyLink() {
    navigator.clipboard.writeText(currentUrl.value);
    copied.value = true;
    setTimeout(() => {
        copied.value = false;
    }, 2000);
}
</script>

<template>
    <Head :title="post.title">
        <meta name="description" :content="post.excerpt" />
    </Head>

    <BlogLayout>
        <!-- Back Link -->
        <div class="mb-8">
            <Link href="/blog" class="inline-flex items-center gap-1 text-sm text-muted-foreground transition-colors hover:text-foreground">
                <ArrowLeft class="size-4" />
                Back to Blog
            </Link>
        </div>

        <!-- Post Header -->
        <header class="mb-10">
            <Badge variant="secondary" class="mb-4">{{ post.category }}</Badge>
            <h1 class="text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">{{ post.title }}</h1>
            <div class="mt-6 flex flex-wrap items-center gap-4 text-sm text-muted-foreground">
                <div class="flex items-center gap-3">
                    <div class="size-10 overflow-hidden rounded-full bg-muted">
                        <img
                            v-if="post.author.photo"
                            :src="post.author.photo"
                            :alt="post.author.name"
                            class="size-full object-cover"
                            loading="lazy"
                        />
                    </div>
                    <span class="font-medium text-foreground">{{ post.author.name }}</span>
                </div>
                <div class="flex items-center gap-1">
                    <Calendar class="size-4" />
                    <span>{{ post.publishedAt }}</span>
                </div>
                <div class="flex items-center gap-1">
                    <Clock class="size-4" />
                    <span>{{ post.readingTime }}</span>
                </div>
            </div>
        </header>

        <!-- Featured Image -->
        <div v-if="post.featuredImage" class="mb-10 overflow-hidden rounded-xl border bg-muted">
            <img
                :src="post.featuredImage"
                :alt="post.title"
                class="aspect-video w-full object-cover"
                loading="eager"
                fetchpriority="high"
            />
        </div>

        <!-- Post Body -->
        <div
            class="prose prose-lg dark:prose-invert max-w-none prose-headings:font-bold prose-headings:tracking-tight prose-a:text-primary prose-a:no-underline hover:prose-a:underline prose-blockquote:border-l-primary prose-blockquote:not-italic prose-img:rounded-xl"
            v-html="post.content"
        />

        <!-- Social Sharing -->
        <div class="mt-12 flex items-center gap-3 border-t pt-8">
            <span class="text-sm font-medium text-muted-foreground">Share this post</span>
            <Button variant="outline" size="sm" @click="shareOnLinkedIn">
                <Linkedin class="me-1.5 size-4" />
                LinkedIn
            </Button>
            <Button variant="outline" size="sm" @click="shareOnTwitter">
                <Twitter class="me-1.5 size-4" />
                X
            </Button>
            <div class="relative">
                <Button variant="outline" size="sm" @click="copyLink">
                    <component :is="copied ? Check : LinkIcon" class="me-1.5 size-4" />
                    {{ copied ? 'Copied!' : 'Copy Link' }}
                </Button>
            </div>
        </div>

        <!-- Author Block -->
        <div class="mt-12 rounded-xl border bg-card p-6 sm:p-8">
            <div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center">
                <div class="size-16 flex-shrink-0 overflow-hidden rounded-full bg-muted">
                    <img
                        v-if="post.author.photo"
                        :src="post.author.photo"
                        :alt="post.author.name"
                        class="size-full object-cover"
                        loading="lazy"
                    />
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-medium uppercase tracking-wider text-muted-foreground">Written by</p>
                    <h3 class="mt-1 text-lg font-semibold">{{ post.author.name }}</h3>
                    <p class="mt-1 text-sm leading-relaxed text-muted-foreground">{{ post.author.bio }}</p>
                    <Link
                        v-if="post.author.url"
                        :href="post.author.url"
                        class="mt-2 inline-flex text-sm font-medium text-primary transition-colors hover:underline"
                    >
                        Learn more about {{ post.author.name }}
                    </Link>
                </div>
            </div>
        </div>

        <!-- Related Posts -->
        <template #related>
            <h2 class="mb-8 text-2xl font-bold tracking-tight">Related Posts</h2>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <BlogPostCard
                    v-for="relatedPost in displayRelatedPosts"
                    :key="relatedPost.slug"
                    :post="relatedPost"
                />
            </div>
        </template>
    </BlogLayout>
</template>
