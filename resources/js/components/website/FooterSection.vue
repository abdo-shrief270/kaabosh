<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import LanguageSwitcher from './LanguageSwitcher.vue';
import { Linkedin, Twitter, Github } from 'lucide-vue-next';
import { useLocale } from '@/composables/useLocale';
import { computed } from 'vue';

const { t } = useLocale();

const productLinks = computed(() => [
    { label: t('products.crm.name'), href: '/products/crm' },
    { label: t('products.analytics.name'), href: '/products/analytics' },
    { label: t('products.helpdesk.name'), href: '/products/helpdesk' },
    { label: t('products.forms.name'), href: '/products/forms' },
]);

const companyLinks = computed(() => [
    { label: t('nav.about'), href: '/about' },
    { label: t('nav.blog'), href: '/blog' },
    { label: t('footer.careers'), href: '/careers' },
    { label: t('footer.press'), href: '/press' },
    { label: t('nav.contact'), href: '/contact' },
]);

const legalLinks = computed(() => [
    { label: t('footer.privacyPolicy'), href: '/privacy-policy' },
    { label: t('footer.termsOfService'), href: '/terms-of-service' },
    { label: t('footer.cookiePolicy'), href: '/cookie-policy' },
]);

const socialLinks = [
    { icon: Linkedin, href: '#', label: 'LinkedIn' },
    { icon: Twitter, href: '#', label: 'Twitter' },
    { icon: Github, href: '#', label: 'GitHub' },
];

const emit = defineEmits<{
    openCookiePreferences: [];
}>();
</script>

<template>
    <footer class="border-t bg-muted/30">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Company Info -->
                <div>
                    <Link
                        href="/"
                        class="flex items-center gap-2 text-lg font-bold"
                    >
                        <div
                            class="flex size-7 items-center justify-center rounded-md bg-primary text-xs font-bold text-primary-foreground"
                        >
                            K
                        </div>
                        <span>Kaabosh</span>
                    </Link>
                    <p
                        class="mt-3 text-sm leading-relaxed text-muted-foreground"
                    >
                        {{ t('footer.description') }}
                    </p>
                    <div class="mt-4 flex gap-3">
                        <a
                            v-for="social in socialLinks"
                            :key="social.label"
                            :href="social.href"
                            class="flex size-9 items-center justify-center rounded-lg border bg-card text-muted-foreground transition-colors hover:bg-accent hover:text-foreground"
                            target="_blank"
                            rel="noopener noreferrer"
                            :aria-label="social.label"
                        >
                            <component :is="social.icon" class="size-4" />
                        </a>
                    </div>
                </div>

                <!-- Products -->
                <div>
                    <h3 class="mb-4 text-sm font-semibold">{{ t('footer.productsTitle') }}</h3>
                    <ul class="space-y-2.5">
                        <li v-for="link in productLinks" :key="link.href">
                            <Link
                                :href="link.href"
                                class="text-sm text-muted-foreground transition-colors hover:text-foreground"
                            >
                                {{ link.label }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h3 class="mb-4 text-sm font-semibold">{{ t('footer.companyTitle') }}</h3>
                    <ul class="space-y-2.5">
                        <li v-for="link in companyLinks" :key="link.href">
                            <Link
                                :href="link.href"
                                class="text-sm text-muted-foreground transition-colors hover:text-foreground"
                            >
                                {{ link.label }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h3 class="mb-4 text-sm font-semibold">{{ t('footer.legalTitle') }}</h3>
                    <ul class="space-y-2.5">
                        <li v-for="link in legalLinks" :key="link.href">
                            <Link
                                :href="link.href"
                                class="text-sm text-muted-foreground transition-colors hover:text-foreground"
                            >
                                {{ link.label }}
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Row -->
        <div class="border-t">
            <div
                class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-4 py-4 sm:flex-row sm:px-6 lg:px-8"
            >
                <p class="text-xs text-muted-foreground">
                    &copy; {{ new Date().getFullYear() }} Kaabosh. {{ t('common.allRightsReserved') }}
                </p>
                <div class="flex items-center gap-4">
                    <button
                        class="text-xs text-muted-foreground transition-colors hover:text-foreground"
                        @click="emit('openCookiePreferences')"
                    >
                        {{ t('common.cookiePreferences') }}
                    </button>
                    <LanguageSwitcher />
                </div>
            </div>
        </div>
    </footer>
</template>
