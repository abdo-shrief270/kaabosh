<script setup lang="ts">
import { ref, computed } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Link } from '@inertiajs/vue3';
import { Loader2, CheckCircle } from 'lucide-vue-next';

const props = withDefaults(
    defineProps<{
        variant?: 'inline' | 'stacked';
        headline?: string;
        productInterest?: string;
    }>(),
    {
        variant: 'inline',
    },
);

const email = ref('');
const status = ref<'idle' | 'loading' | 'success' | 'error' | 'duplicate'>(
    'idle',
);
const errorMessage = ref('');

const isValidEmail = computed(() =>
    /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value),
);

async function submit() {
    if (!isValidEmail.value) return;
    status.value = 'loading';
    errorMessage.value = '';

    try {
        // Simulate API call
        await new Promise((r) => setTimeout(r, 1500));
        status.value = 'success';
    } catch {
        status.value = 'error';
        errorMessage.value = 'Something went wrong. Please try again.';
    }
}
</script>

<template>
    <!-- Success State -->
    <div
        v-if="status === 'success'"
        class="flex items-center justify-center gap-2 py-4 text-sm"
    >
        <CheckCircle class="size-5 text-green-600 dark:text-green-400" />
        <span>You're on the list! Check your email.</span>
    </div>

    <!-- Form -->
    <form v-else @submit.prevent="submit">
        <div
            :class="
                variant === 'inline'
                    ? 'mx-auto flex max-w-md flex-col gap-3 sm:flex-row'
                    : 'mx-auto flex max-w-sm flex-col gap-3'
            "
        >
            <Input
                v-model="email"
                type="email"
                placeholder="Enter your email"
                :disabled="status === 'loading'"
                class="flex-1"
                required
            />
            <Button
                type="submit"
                :disabled="!isValidEmail || status === 'loading'"
                :class="variant === 'stacked' ? 'w-full' : ''"
            >
                <Loader2
                    v-if="status === 'loading'"
                    class="mr-2 size-4 animate-spin"
                />
                {{ status === 'loading' ? 'Joining...' : 'Join Waitlist' }}
            </Button>
        </div>

        <!-- Error -->
        <p
            v-if="status === 'error'"
            class="mt-2 text-center text-sm text-destructive"
        >
            {{ errorMessage }}
        </p>
        <p
            v-if="status === 'duplicate'"
            class="mt-2 text-center text-sm text-amber-600 dark:text-amber-400"
        >
            You're already signed up!
        </p>

        <!-- Privacy micro-copy -->
        <p class="mt-3 text-center text-xs text-muted-foreground">
            By signing up you agree to our
            <Link href="/privacy-policy" class="underline hover:text-foreground"
                >Privacy Policy</Link
            >. Unsubscribe anytime.
        </p>
    </form>
</template>
