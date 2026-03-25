<script setup lang="ts">
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import DarkModeToggle from './DarkModeToggle.vue';
import LanguageSwitcher from './LanguageSwitcher.vue';
import SkipToContent from './SkipToContent.vue';
import { Menu, X, Search, ChevronDown, ArrowRight } from 'lucide-vue-next';
import { useLocale } from '@/composables/useLocale';
import SearchModal from './SearchModal.vue';

const { t } = useLocale();

const mobileOpen = ref(false);
const productsOpen = ref(false);
const searchModalRef = ref<InstanceType<typeof SearchModal> | null>(null);
const page = usePage();

const currentUrl = computed(() => page.url);

const navItems = computed(() => [
    { label: t('nav.products'), href: '/products', hasMega: true },
    { label: t('nav.pricing'), href: '/pricing' },
    { label: t('nav.blog'), href: '/blog' },
    { label: t('nav.about'), href: '/about' },
    { label: t('nav.contact'), href: '/contact' },
]);

const megaProducts = computed(() => [
    { name: t('products.crm.name'), slug: 'crm', description: t('products.crm.tagline') },
    { name: t('products.analytics.name'), slug: 'analytics', description: t('products.analytics.tagline') },
    { name: t('products.helpdesk.name'), slug: 'helpdesk', description: t('products.helpdesk.tagline') },
    { name: t('products.forms.name'), slug: 'forms', description: t('products.forms.tagline') },
]);

function isActive(href: string) {
    if (href === '/') return currentUrl.value === '/';
    return currentUrl.value.startsWith(href);
}

function closeMobile() {
    mobileOpen.value = false;
    productsOpen.value = false;
}

function handleEscape(e: KeyboardEvent) {
    if (e.key === 'Escape') closeMobile();
}
</script>

<template>
    <SkipToContent />
    <SearchModal ref="searchModalRef" />
    <header class="sticky top-0 z-50 w-full border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <!-- Logo -->
            <Link href="/" class="flex items-center gap-2 font-bold text-xl">
                <div class="flex size-8 items-center justify-center rounded-lg bg-primary text-primary-foreground text-sm font-bold">K</div>
                <span>Kaabosh</span>
            </Link>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-1" aria-label="Main navigation">
                <div
                    v-for="item in navItems"
                    :key="item.href"
                    class="relative"
                    :class="item.hasMega ? 'group' : ''"
                >
                    <Link
                        v-if="!item.hasMega"
                        :href="item.href"
                        class="rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground"
                        :class="isActive(item.href) ? 'text-foreground' : 'text-muted-foreground'"
                    >
                        {{ item.label }}
                    </Link>
                    <button
                        v-else
                        class="flex items-center gap-1 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground"
                        :class="isActive(item.href) ? 'text-foreground' : 'text-muted-foreground'"
                    >
                        {{ item.label }}
                        <ChevronDown class="size-3" />
                    </button>

                    <!-- Mega Menu -->
                    <div
                        v-if="item.hasMega"
                        class="invisible absolute top-full pt-2 opacity-0 transition-all duration-200 group-hover:visible group-hover:opacity-100 ltr:left-1/2 ltr:-translate-x-1/2 rtl:right-1/2 rtl:translate-x-1/2"
                    >
                        <div class="w-[480px] rounded-xl border bg-popover p-4 shadow-lg">
                            <div class="grid grid-cols-2 gap-2">
                                <Link
                                    v-for="product in megaProducts"
                                    :key="product.slug"
                                    :href="`/products/${product.slug}`"
                                    class="flex items-start gap-3 rounded-lg p-3 transition-colors hover:bg-accent"
                                >
                                    <div class="flex size-9 shrink-0 items-center justify-center rounded-md bg-primary/10 text-primary text-xs font-bold">
                                        {{ product.name.split(' ')[1]?.[0] || 'K' }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold">{{ product.name }}</div>
                                        <div class="text-xs text-muted-foreground">{{ product.description }}</div>
                                    </div>
                                </Link>
                            </div>
                            <div class="mt-3 border-t pt-3">
                                <Link href="/products" class="flex items-center gap-1 text-sm font-medium text-muted-foreground hover:text-foreground transition-colors">
                                    {{ t('common.viewAll') }}
                                    <ArrowRight class="size-3 rtl:rotate-180" />
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Desktop Right Controls -->
            <div class="hidden md:flex items-center gap-1">
                <LanguageSwitcher />
                <DarkModeToggle />
                <Button variant="ghost" size="icon" title="Search (Ctrl+K)" @click="searchModalRef?.open()">
                    <Search class="size-5" />
                </Button>
                <Button as-child size="sm" class="ms-2">
                    <Link href="/pricing">{{ t('common.getStarted') }}</Link>
                </Button>
            </div>

            <!-- Mobile Hamburger -->
            <button
                class="md:hidden flex size-10 items-center justify-center rounded-md hover:bg-accent"
                @click="mobileOpen = true"
                aria-label="Open menu"
            >
                <Menu class="size-6" />
            </button>
        </div>
    </header>

    <!-- Mobile Overlay -->
    <Teleport to="body">
        <Transition
            enter-active-class="transition-opacity duration-200"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition-opacity duration-200"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-if="mobileOpen"
                class="fixed inset-0 z-[60] bg-background/80 backdrop-blur-sm md:hidden"
                @click="closeMobile"
                @keydown="handleEscape"
            >
                <div
                    class="fixed inset-y-0 w-full max-w-sm bg-background border-s shadow-xl ltr:right-0 rtl:left-0"
                    @click.stop
                >
                    <div class="flex h-16 items-center justify-between px-4 border-b">
                        <span class="font-bold text-lg">{{ t('common.menu') }}</span>
                        <button
                            class="flex size-10 items-center justify-center rounded-md hover:bg-accent"
                            @click="closeMobile"
                            aria-label="Close menu"
                        >
                            <X class="size-6" />
                        </button>
                    </div>

                    <nav class="flex flex-col p-4 gap-1" aria-label="Mobile navigation">
                        <template v-for="item in navItems" :key="item.href">
                            <template v-if="item.hasMega">
                                <button
                                    class="flex w-full items-center justify-between rounded-lg px-3 py-3 text-sm font-medium hover:bg-accent"
                                    @click="productsOpen = !productsOpen"
                                >
                                    {{ item.label }}
                                    <ChevronDown class="size-4 transition-transform" :class="productsOpen ? 'rotate-180' : ''" />
                                </button>
                                <div v-if="productsOpen" class="ms-4 space-y-1">
                                    <Link
                                        v-for="product in megaProducts"
                                        :key="product.slug"
                                        :href="`/products/${product.slug}`"
                                        class="block rounded-lg px-3 py-2 text-sm text-muted-foreground hover:bg-accent hover:text-foreground"
                                        @click="closeMobile"
                                    >
                                        {{ product.name }}
                                    </Link>
                                    <Link
                                        href="/products"
                                        class="block rounded-lg px-3 py-2 text-sm font-medium text-primary hover:bg-accent"
                                        @click="closeMobile"
                                    >
                                        {{ t('common.viewAll') }}
                                    </Link>
                                </div>
                            </template>
                            <Link
                                v-else
                                :href="item.href"
                                class="rounded-lg px-3 py-3 text-sm font-medium hover:bg-accent"
                                :class="isActive(item.href) ? 'text-foreground bg-accent' : 'text-muted-foreground'"
                                @click="closeMobile"
                            >
                                {{ item.label }}
                            </Link>
                        </template>
                    </nav>

                    <div class="absolute bottom-0 left-0 right-0 border-t p-4 space-y-3">
                        <div class="flex items-center gap-2">
                            <LanguageSwitcher />
                            <DarkModeToggle />
                        </div>
                        <Button as-child class="w-full" @click="closeMobile">
                            <Link href="/pricing">{{ t('common.getStarted') }}</Link>
                        </Button>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
