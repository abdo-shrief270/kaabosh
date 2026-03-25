<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    title: string;
    description: string;
    canonicalPath: string;
    ogImage?: string;
    ogType?: string;
    jsonLd?: object | object[];
}>();

const BASE_URL = 'https://kaabosh.com';

const truncatedTitle = computed(() => {
    if (props.title.length <= 60) return props.title;
    return props.title.slice(0, 57).trimEnd() + '...';
});

const truncatedDescription = computed(() => {
    if (props.description.length <= 160) return props.description;
    return props.description.slice(0, 157).trimEnd() + '...';
});

const canonicalUrl = computed(() => `${BASE_URL}${props.canonicalPath}`);

const jsonLdString = computed(() => {
    if (!props.jsonLd) return null;
    return JSON.stringify(Array.isArray(props.jsonLd) ? props.jsonLd : props.jsonLd);
});
</script>

<template>
    <Head :title="truncatedTitle">
        <meta head-key="description" name="description" :content="truncatedDescription" />
        <link head-key="canonical" rel="canonical" :href="canonicalUrl" />

        <!-- Open Graph -->
        <meta head-key="og:title" property="og:title" :content="truncatedTitle" />
        <meta head-key="og:description" property="og:description" :content="truncatedDescription" />
        <meta head-key="og:url" property="og:url" :content="canonicalUrl" />
        <meta head-key="og:type" property="og:type" :content="ogType ?? 'website'" />
        <meta v-if="ogImage" head-key="og:image" property="og:image" :content="ogImage" />

        <!-- Twitter Card -->
        <meta head-key="twitter:card" name="twitter:card" content="summary_large_image" />
        <meta head-key="twitter:title" name="twitter:title" :content="truncatedTitle" />
        <meta head-key="twitter:description" name="twitter:description" :content="truncatedDescription" />
        <meta v-if="ogImage" head-key="twitter:image" name="twitter:image" :content="ogImage" />

        <!-- Hreflang -->
        <link head-key="hreflang-en" rel="alternate" hreflang="en" :href="canonicalUrl" />
        <link head-key="hreflang-ar" rel="alternate" hreflang="ar" :href="`${BASE_URL}/ar${canonicalPath}`" />
        <link head-key="hreflang-fr" rel="alternate" hreflang="fr" :href="`${BASE_URL}/fr${canonicalPath}`" />
        <link head-key="hreflang-x-default" rel="alternate" hreflang="x-default" :href="canonicalUrl" />

        <!-- JSON-LD -->
        <component
            v-if="jsonLdString"
            :is="'script'"
            type="application/ld+json"
            v-text="jsonLdString"
        />
    </Head>
</template>
