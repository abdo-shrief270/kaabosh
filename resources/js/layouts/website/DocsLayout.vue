<script setup lang="ts">
import DefaultLayout from './DefaultLayout.vue';
import { ref } from 'vue';
import { Menu, X } from 'lucide-vue-next';

defineProps<{
    sidebarNav?: Array<{ title: string; href: string; active?: boolean }>;
}>();

const sidebarOpen = ref(false);
</script>

<template>
    <DefaultLayout>
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
            <div class="flex gap-8">
                <!-- Mobile sidebar toggle -->
                <button
                    class="fixed right-4 bottom-4 z-40 flex size-12 items-center justify-center rounded-full bg-primary text-primary-foreground shadow-lg lg:hidden"
                    @click="sidebarOpen = !sidebarOpen"
                >
                    <Menu v-if="!sidebarOpen" class="size-5" />
                    <X v-else class="size-5" />
                </button>

                <!-- Left Sidebar -->
                <aside
                    class="fixed inset-y-0 left-0 z-30 w-64 border-r bg-background p-6 pt-20 transition-transform lg:static lg:block lg:w-56 lg:shrink-0 lg:translate-x-0 lg:border-r-0 lg:p-0 lg:pt-0"
                    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                >
                    <nav
                        class="space-y-1"
                        aria-label="Documentation navigation"
                    >
                        <a
                            v-for="item in sidebarNav"
                            :key="item.href"
                            :href="item.href"
                            class="block rounded-lg px-3 py-2 text-sm transition-colors"
                            :class="
                                item.active
                                    ? 'bg-accent font-medium text-foreground'
                                    : 'text-muted-foreground hover:bg-accent hover:text-foreground'
                            "
                            @click="sidebarOpen = false"
                        >
                            {{ item.title }}
                        </a>
                    </nav>
                </aside>

                <!-- Main Content -->
                <div class="mx-auto max-w-[720px] min-w-0 flex-1">
                    <div class="prose prose-sm dark:prose-invert max-w-none">
                        <slot />
                    </div>
                </div>

                <!-- Right TOC (desktop only) -->
                <aside class="hidden w-48 shrink-0 xl:block">
                    <div class="sticky top-28">
                        <h4 class="mb-3 text-sm font-semibold">On this page</h4>
                        <nav class="space-y-1" aria-label="Table of contents">
                            <a
                                v-for="item in sidebarNav"
                                :key="item.href"
                                :href="item.href"
                                class="block py-1 text-xs text-muted-foreground transition-colors hover:text-foreground"
                            >
                                {{ item.title }}
                            </a>
                        </nav>
                    </div>
                </aside>
            </div>
        </div>
    </DefaultLayout>
</template>
