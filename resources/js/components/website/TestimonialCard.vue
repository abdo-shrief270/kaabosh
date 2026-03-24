<script setup lang="ts">
import { Badge } from '@/components/ui/badge';
import { Quote } from 'lucide-vue-next';

defineProps<{
    quote: string;
    customerName: string;
    jobTitle: string;
    company: string;
    photoUrl?: string;
    productUsed?: string;
}>();
</script>

<template>
    <div class="rounded-xl border bg-card p-6">
        <Quote class="size-6 text-primary/30 mb-3" />
        <p class="text-sm leading-relaxed">{{ quote }}</p>
        <div class="mt-4 flex items-center gap-3">
            <div class="size-10 rounded-full bg-muted overflow-hidden shrink-0">
                <img
                    v-if="photoUrl"
                    :src="photoUrl"
                    :alt="customerName"
                    class="size-full object-cover"
                    loading="lazy"
                />
            </div>
            <div class="min-w-0">
                <div class="text-sm font-semibold truncate">{{ customerName }}</div>
                <div class="text-xs text-muted-foreground truncate">{{ jobTitle }}, {{ company }}</div>
            </div>
            <Badge v-if="productUsed" variant="secondary" class="ml-auto text-xs shrink-0">
                {{ productUsed }}
            </Badge>
        </div>
    </div>
</template>
