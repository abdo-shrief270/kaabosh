<script setup lang="ts">
import { ref } from 'vue';
import { ChevronDown } from 'lucide-vue-next';

defineProps<{
    items: Array<{ question: string; answer: string }>;
}>();

const openIndex = ref<number | null>(null);

function toggle(index: number) {
    openIndex.value = openIndex.value === index ? null : index;
}
</script>

<template>
    <div class="space-y-2">
        <div
            v-for="(item, index) in items"
            :key="index"
            class="overflow-hidden rounded-xl border bg-card"
        >
            <button
                :id="`faq-trigger-${index}`"
                class="flex w-full items-center justify-between p-4 text-left text-sm font-medium transition-colors hover:bg-accent/50"
                :aria-expanded="openIndex === index"
                :aria-controls="`faq-panel-${index}`"
                @click="toggle(index)"
                @keydown.enter.prevent="toggle(index)"
                @keydown.space.prevent="toggle(index)"
            >
                <span>{{ item.question }}</span>
                <ChevronDown
                    class="size-4 shrink-0 text-muted-foreground transition-transform duration-200"
                    :class="openIndex === index ? 'rotate-180' : ''"
                />
            </button>
            <div
                :id="`faq-panel-${index}`"
                role="region"
                :aria-labelledby="`faq-trigger-${index}`"
                class="grid transition-all duration-200 ease-in-out"
                :class="
                    openIndex === index ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'
                "
            >
                <div class="overflow-hidden">
                    <div
                        class="px-4 pb-4 text-sm leading-relaxed text-muted-foreground"
                    >
                        {{ item.answer }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
