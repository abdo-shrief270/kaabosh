<script setup lang="ts">
import { ref, watch, onMounted, onUnmounted, nextTick } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Badge } from '@/components/ui/badge';
import { Search, X, ArrowRight } from 'lucide-vue-next';

const isOpen = ref(false);
const query = ref('');
const selectedIndex = ref(0);
const inputRef = ref<HTMLInputElement | null>(null);
let debounceTimer: ReturnType<typeof setTimeout>;

interface SearchResult {
    title: string;
    type: 'Page' | 'Product' | 'Blog' | 'Docs';
    excerpt: string;
    url: string;
}

const results = ref<SearchResult[]>([]);
const loading = ref(false);

// Mock search results
const allItems: SearchResult[] = [
    { title: 'Home', type: 'Page', excerpt: 'Welcome to Kaabosh', url: '/' },
    { title: 'Products', type: 'Page', excerpt: 'Explore our product suite', url: '/products' },
    { title: 'Pricing', type: 'Page', excerpt: 'Simple, transparent pricing', url: '/pricing' },
    { title: 'About', type: 'Page', excerpt: 'Learn about our team and mission', url: '/about' },
    { title: 'Contact', type: 'Page', excerpt: 'Get in touch with us', url: '/contact' },
    { title: 'Kaabosh CRM', type: 'Product', excerpt: 'Customer relationships, simplified', url: '/products/crm' },
    { title: 'Kaabosh Analytics', type: 'Product', excerpt: 'Data-driven decisions', url: '/products/analytics' },
    { title: 'Kaabosh Helpdesk', type: 'Product', excerpt: 'Support that scales', url: '/products/helpdesk' },
];

const suggestedLinks = [
    { label: 'Products', url: '/products' },
    { label: 'Pricing', url: '/pricing' },
    { label: 'Contact Sales', url: '/contact' },
    { label: 'CRM Docs', url: '/products/crm/docs' },
];

watch(query, (val) => {
    clearTimeout(debounceTimer);
    if (val.length < 3) {
        results.value = [];
        return;
    }
    loading.value = true;
    debounceTimer = setTimeout(() => {
        const q = val.toLowerCase();
        results.value = allItems.filter(
            item => item.title.toLowerCase().includes(q) || item.excerpt.toLowerCase().includes(q)
        );
        loading.value = false;
        selectedIndex.value = 0;
    }, 300);
});

function open() {
    isOpen.value = true;
    query.value = '';
    results.value = [];
    nextTick(() => {
        inputRef.value?.focus();
    });
}

function close() {
    isOpen.value = false;
}

function handleKeydown(e: KeyboardEvent) {
    if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
        e.preventDefault();
        open();
    }
    if (!isOpen.value) return;
    if (e.key === 'Escape') close();
    if (e.key === 'ArrowDown') {
        e.preventDefault();
        selectedIndex.value = Math.min(selectedIndex.value + 1, results.value.length - 1);
    }
    if (e.key === 'ArrowUp') {
        e.preventDefault();
        selectedIndex.value = Math.max(selectedIndex.value - 1, 0);
    }
    if (e.key === 'Enter' && results.value[selectedIndex.value]) {
        window.location.href = results.value[selectedIndex.value].url;
        close();
    }
}

onMounted(() => {
    document.addEventListener('keydown', handleKeydown);
});

onUnmounted(() => {
    document.removeEventListener('keydown', handleKeydown);
});

const typeBadgeClass: Record<string, string> = {
    Page: 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
    Product: 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
    Blog: 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300',
    Docs: 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300',
};

defineExpose({ open });
</script>

<template>
    <Teleport to="body">
        <Transition
            enter-active-class="transition-opacity duration-150"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition-opacity duration-100"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-if="isOpen"
                class="fixed inset-0 z-[80] flex items-start justify-center bg-background/80 backdrop-blur-sm pt-[15vh]"
                @click.self="close"
            >
                <div class="w-full max-w-lg rounded-xl border bg-popover shadow-2xl" @keydown="handleKeydown">
                    <div class="flex items-center gap-3 border-b px-4 py-3">
                        <Search class="size-5 text-muted-foreground shrink-0" />
                        <input
                            ref="inputRef"
                            v-model="query"
                            type="text"
                            placeholder="Search..."
                            class="flex-1 bg-transparent text-sm outline-none placeholder:text-muted-foreground"
                        />
                        <kbd class="hidden sm:inline-flex items-center rounded border px-1.5 py-0.5 text-xs text-muted-foreground">
                            ESC
                        </kbd>
                    </div>

                    <div class="max-h-80 overflow-y-auto p-2">
                        <!-- Loading -->
                        <div v-if="loading" class="py-8 text-center text-sm text-muted-foreground">
                            Searching...
                        </div>

                        <!-- Results -->
                        <div v-else-if="results.length > 0">
                            <button
                                v-for="(result, i) in results"
                                :key="result.url"
                                class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm transition-colors"
                                :class="i === selectedIndex ? 'bg-accent' : 'hover:bg-accent/50'"
                                @click="window.location.href = result.url; close()"
                                @mouseenter="selectedIndex = i"
                            >
                                <span
                                    class="inline-flex rounded px-1.5 py-0.5 text-xs font-medium"
                                    :class="typeBadgeClass[result.type]"
                                >
                                    {{ result.type }}
                                </span>
                                <div class="flex-1 min-w-0">
                                    <div class="font-medium truncate">{{ result.title }}</div>
                                    <div class="text-xs text-muted-foreground truncate">{{ result.excerpt }}</div>
                                </div>
                                <ArrowRight class="size-4 text-muted-foreground shrink-0" />
                            </button>
                        </div>

                        <!-- Empty state -->
                        <div v-else-if="query.length >= 3 && !loading" class="py-8 text-center">
                            <p class="text-sm text-muted-foreground">No results for "{{ query }}"</p>
                            <div class="mt-4 space-y-1">
                                <p class="text-xs text-muted-foreground mb-2">Try these popular pages:</p>
                                <a
                                    v-for="link in suggestedLinks"
                                    :key="link.url"
                                    :href="link.url"
                                    class="block rounded-lg px-3 py-2 text-sm hover:bg-accent transition-colors"
                                    @click="close"
                                >
                                    {{ link.label }}
                                </a>
                            </div>
                        </div>

                        <!-- Initial state -->
                        <div v-else class="py-8 text-center text-sm text-muted-foreground">
                            Type at least 3 characters to search...
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
