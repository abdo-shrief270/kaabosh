<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Head, Link } from '@inertiajs/vue3';
import { Search, Home, Package } from 'lucide-vue-next';
import { computed } from 'vue';

const props = withDefaults(
    defineProps<{
        status?: number;
    }>(),
    {
        status: 404,
    },
);

const title = computed(() => {
    if (props.status === 500) return 'Something Went Wrong';
    if (props.status === 503) return 'Service Unavailable';
    return 'Page Not Found';
});

const description = computed(() => {
    if (props.status === 500)
        return "We're experiencing technical difficulties. Please try again in a moment.";
    if (props.status === 503)
        return "We're undergoing maintenance. We'll be back shortly.";
    return "The page you're looking for doesn't exist or has been moved.";
});
</script>

<template>
    <Head :title="title" />

    <DefaultLayout>
        <section class="flex min-h-[60vh] items-center justify-center py-20">
            <div class="mx-auto max-w-lg px-4 text-center">
                <div class="text-8xl font-bold text-muted-foreground/20">
                    {{ status }}
                </div>
                <h1 class="mt-4 text-3xl font-bold tracking-tight">
                    {{ title }}
                </h1>
                <p class="mt-4 text-lg text-muted-foreground">
                    {{ description }}
                </p>

                <div
                    v-if="status === 404"
                    class="mt-8 flex flex-col items-center gap-4"
                >
                    <div class="relative w-full max-w-sm">
                        <Search
                            class="absolute top-1/2 left-3 size-4 -translate-y-1/2 text-muted-foreground"
                        />
                        <Input placeholder="Search our site..." class="pl-9" />
                    </div>
                    <div class="flex gap-3">
                        <Button as-child>
                            <Link href="/">
                                <Home class="mr-2 size-4" />
                                Homepage
                            </Link>
                        </Button>
                        <Button as-child variant="outline">
                            <Link href="/products">
                                <Package class="mr-2 size-4" />
                                Products
                            </Link>
                        </Button>
                    </div>
                </div>

                <div v-else class="mt-8 flex justify-center gap-3">
                    <Button @click="() => window.location.reload()"
                        >Try Again</Button
                    >
                    <Button as-child variant="outline">
                        <Link href="/">Back to Homepage</Link>
                    </Button>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
