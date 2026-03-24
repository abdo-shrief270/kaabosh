<script setup lang="ts">
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
import { CheckCircle, ArrowRight } from 'lucide-vue-next';

interface Tab {
    id: string;
    label: string;
    headline: string;
    body: string;
    benefits: string[];
    ctaLabel: string;
    ctaUrl: string;
}

const props = defineProps<{
    tabs: Tab[];
}>();

const activeTab = ref(props.tabs[0]?.id);

function activeTabData() {
    return props.tabs.find((t) => t.id === activeTab.value) || props.tabs[0];
}
</script>

<template>
    <div>
        <!-- Tab Bar -->
        <div class="mb-8 flex flex-wrap justify-center gap-2">
            <button
                v-for="tab in tabs"
                :key="tab.id"
                class="rounded-full px-4 py-2 text-sm font-medium transition-colors"
                :class="
                    activeTab === tab.id
                        ? 'bg-primary text-primary-foreground'
                        : 'bg-muted text-muted-foreground hover:bg-muted/80'
                "
                @click="activeTab = tab.id"
            >
                {{ tab.label }}
            </button>
        </div>

        <!-- Content Panel -->
        <div
            class="mx-auto max-w-2xl rounded-xl border bg-card p-8 text-center"
        >
            <h3 class="text-2xl font-bold">{{ activeTabData().headline }}</h3>
            <p class="mt-4 text-muted-foreground">{{ activeTabData().body }}</p>
            <ul class="mt-6 space-y-2">
                <li
                    v-for="benefit in activeTabData().benefits"
                    :key="benefit"
                    class="flex items-center justify-center gap-2 text-sm"
                >
                    <CheckCircle
                        class="size-4 shrink-0 text-green-600 dark:text-green-400"
                    />
                    {{ benefit }}
                </li>
            </ul>
            <Button as-child class="mt-6" size="lg">
                <Link :href="activeTabData().ctaUrl">
                    {{ activeTabData().ctaLabel }}
                    <ArrowRight class="ml-2 size-4" />
                </Link>
            </Button>
        </div>
    </div>
</template>
