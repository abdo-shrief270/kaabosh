<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Globe } from 'lucide-vue-next';
import { useLocale, type Locale } from '@/composables/useLocale';

const { locale, setLocale, t } = useLocale();

const locales: Array<{ code: Locale; label: string }> = [
    { code: 'en', label: 'English' },
    { code: 'ar', label: 'العربية' },
];
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="ghost" size="icon" :title="t('common.switchLanguage')">
                <Globe class="size-5" />
                <span class="sr-only">{{ t('common.switchLanguage') }}</span>
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end">
            <DropdownMenuItem
                v-for="loc in locales"
                :key="loc.code"
                :class="locale === loc.code ? 'font-semibold' : ''"
                @click="setLocale(loc.code)"
            >
                {{ loc.label }}
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
