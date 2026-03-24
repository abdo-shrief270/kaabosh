<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Link } from '@inertiajs/vue3';
import { Check } from 'lucide-vue-next';

defineProps<{
    plan: {
        name: string;
        price: string;
        interval?: string;
        description: string;
        features: string[];
        isPopular?: boolean;
        isEnterprise?: boolean;
        ctaLabel: string;
        ctaUrl: string;
    };
    showSavings?: boolean;
    savingsPercent?: number;
}>();
</script>

<template>
    <div
        class="relative rounded-xl border bg-card p-6 flex flex-col"
        :class="plan.isPopular ? 'border-primary shadow-lg ring-1 ring-primary' : ''"
    >
        <Badge
            v-if="plan.isPopular"
            class="absolute -top-3 left-1/2 -translate-x-1/2"
        >
            Most Popular
        </Badge>

        <div class="mb-4">
            <h3 class="text-lg font-semibold">{{ plan.name }}</h3>
            <div class="mt-2 flex items-baseline gap-1">
                <span class="text-3xl font-bold">{{ plan.price }}</span>
                <span v-if="plan.interval" class="text-sm text-muted-foreground">{{ plan.interval }}</span>
            </div>
            <Badge
                v-if="showSavings && savingsPercent"
                variant="secondary"
                class="mt-2 text-xs text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/30"
            >
                Save {{ savingsPercent }}%
            </Badge>
            <p class="mt-2 text-sm text-muted-foreground">{{ plan.description }}</p>
        </div>

        <ul class="space-y-2.5 mb-6 flex-1">
            <li
                v-for="feature in plan.features"
                :key="feature"
                class="flex items-start gap-2 text-sm"
            >
                <Check class="size-4 shrink-0 text-green-600 dark:text-green-400 mt-0.5" />
                <span>{{ feature }}</span>
            </li>
        </ul>

        <Button
            as-child
            :variant="plan.isPopular ? 'default' : plan.isEnterprise ? 'outline' : 'secondary'"
            class="w-full"
        >
            <Link :href="plan.ctaUrl">{{ plan.ctaLabel }}</Link>
        </Button>
    </div>
</template>
