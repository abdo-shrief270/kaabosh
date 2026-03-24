<script setup lang="ts">
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { MessageCircle, X, Send, Loader2 } from 'lucide-vue-next';

const props = withDefaults(defineProps<{
    online?: boolean;
}>(), {
    online: false,
});

const isOpen = ref(false);
const formData = ref({ name: '', email: '', message: '' });
const submitting = ref(false);
const submitted = ref(false);

function toggle() {
    isOpen.value = !isOpen.value;
}

async function submitOfflineForm() {
    if (!formData.value.name || !formData.value.email || !formData.value.message) return;
    submitting.value = true;
    // Simulate API
    await new Promise(r => setTimeout(r, 1000));
    submitting.value = false;
    submitted.value = true;
}
</script>

<template>
    <!-- Chat Panel -->
    <Teleport to="body">
        <Transition
            enter-active-class="transition-all duration-200 ease-out"
            enter-from-class="opacity-0 translate-y-4 scale-95"
            enter-to-class="opacity-100 translate-y-0 scale-100"
            leave-active-class="transition-all duration-150 ease-in"
            leave-from-class="opacity-100 translate-y-0 scale-100"
            leave-to-class="opacity-0 translate-y-4 scale-95"
        >
            <div
                v-if="isOpen"
                class="fixed bottom-20 right-4 z-[60] w-80 rounded-xl border bg-card shadow-2xl sm:right-6"
            >
                <!-- Header -->
                <div class="flex items-center justify-between border-b p-4">
                    <div class="flex items-center gap-2">
                        <div
                            class="size-2.5 rounded-full"
                            :class="online ? 'bg-green-500' : 'bg-muted-foreground/40'"
                        />
                        <span class="text-sm font-semibold">
                            {{ online ? 'Chat with us' : 'Leave a message' }}
                        </span>
                    </div>
                    <button class="rounded p-1 hover:bg-accent transition-colors" @click="toggle" aria-label="Close chat">
                        <X class="size-4" />
                    </button>
                </div>

                <!-- Body -->
                <div class="p-4">
                    <template v-if="online">
                        <p class="text-sm text-muted-foreground mb-3">
                            Hi there! How can we help you today?
                        </p>
                        <p class="text-xs text-muted-foreground">
                            Live chat integration will be connected here.
                        </p>
                    </template>

                    <!-- Offline Form -->
                    <template v-else>
                        <div v-if="submitted" class="py-4 text-center">
                            <p class="text-sm font-medium">Message sent!</p>
                            <p class="mt-1 text-xs text-muted-foreground">We'll get back to you via email.</p>
                        </div>
                        <form v-else class="space-y-3" @submit.prevent="submitOfflineForm">
                            <p class="text-xs text-muted-foreground mb-2">
                                We're offline right now. Leave a message and we'll get back to you.
                            </p>
                            <div>
                                <Label for="chat-name" class="text-xs">Name</Label>
                                <Input id="chat-name" v-model="formData.name" placeholder="Your name" class="mt-1 h-8 text-sm" required />
                            </div>
                            <div>
                                <Label for="chat-email" class="text-xs">Email</Label>
                                <Input id="chat-email" v-model="formData.email" type="email" placeholder="you@example.com" class="mt-1 h-8 text-sm" required />
                            </div>
                            <div>
                                <Label for="chat-msg" class="text-xs">Message</Label>
                                <textarea
                                    id="chat-msg"
                                    v-model="formData.message"
                                    rows="3"
                                    placeholder="How can we help?"
                                    class="mt-1 flex w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-xs focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                                    required
                                />
                            </div>
                            <Button type="submit" size="sm" class="w-full" :disabled="submitting">
                                <Loader2 v-if="submitting" class="mr-2 size-3 animate-spin" />
                                <Send v-else class="mr-2 size-3" />
                                {{ submitting ? 'Sending...' : 'Send Message' }}
                            </Button>
                        </form>
                    </template>
                </div>
            </div>
        </Transition>

        <!-- Bubble Button -->
        <button
            class="fixed bottom-4 right-4 z-[59] flex size-12 items-center justify-center rounded-full shadow-lg transition-colors sm:right-6"
            :class="online
                ? 'bg-primary text-primary-foreground hover:bg-primary/90'
                : 'bg-muted-foreground/70 text-white hover:bg-muted-foreground/80'"
            @click="toggle"
            :aria-label="isOpen ? 'Close chat' : 'Open chat'"
        >
            <X v-if="isOpen" class="size-5" />
            <MessageCircle v-else class="size-5" />
        </button>
    </Teleport>
</template>
