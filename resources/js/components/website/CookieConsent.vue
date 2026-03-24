<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogFooter,
    DialogDescription,
} from '@/components/ui/dialog';
import { X } from 'lucide-vue-next';

const showBanner = ref(false);
const showPreferences = ref(false);

const analytics = ref(false);
const marketing = ref(false);

onMounted(() => {
    const consent = getCookie('consent_preferences');
    if (!consent) {
        showBanner.value = true;
    }
});

function getCookie(name: string): string | null {
    const match = document.cookie.match(
        new RegExp('(^| )' + name + '=([^;]+)'),
    );
    return match ? match[2] : null;
}

function setCookie(name: string, value: string) {
    const maxAge = 365 * 24 * 60 * 60; // 12 months
    document.cookie = `${name}=${value};path=/;max-age=${maxAge};SameSite=Lax`;
}

function saveConsent(analyticsOn: boolean, marketingOn: boolean) {
    const preferences = JSON.stringify({
        necessary: true,
        analytics: analyticsOn,
        marketing: marketingOn,
    });
    setCookie('consent_preferences', encodeURIComponent(preferences));
    showBanner.value = false;
    showPreferences.value = false;
}

function acceptAll() {
    saveConsent(true, true);
}

function rejectAll() {
    saveConsent(false, false);
}

function savePreferences() {
    saveConsent(analytics.value, marketing.value);
}

function openPreferences() {
    showPreferences.value = true;
}

defineExpose({ openPreferences });
</script>

<template>
    <!-- Banner -->
    <Teleport to="body">
        <Transition
            enter-active-class="transition-transform duration-300 ease-out"
            enter-from-class="translate-y-full"
            enter-to-class="translate-y-0"
            leave-active-class="transition-transform duration-200 ease-in"
            leave-from-class="translate-y-0"
            leave-to-class="translate-y-full"
        >
            <div
                v-if="showBanner"
                class="fixed right-0 bottom-0 left-0 z-[70] border-t bg-background p-4 shadow-lg sm:p-6"
            >
                <div
                    class="mx-auto flex max-w-7xl flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
                >
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        We use cookies to improve your experience. By continuing
                        to use our site, you consent to our use of essential
                        cookies. You can manage your preferences for analytics
                        and marketing cookies.
                    </p>
                    <div class="flex shrink-0 flex-wrap gap-2">
                        <Button
                            variant="outline"
                            size="sm"
                            @click="openPreferences"
                            >Manage Preferences</Button
                        >
                        <Button variant="outline" size="sm" @click="rejectAll"
                            >Reject All</Button
                        >
                        <Button size="sm" @click="acceptAll">Accept All</Button>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>

    <!-- Preferences Modal -->
    <Dialog v-model:open="showPreferences">
        <DialogContent class="sm:max-w-md">
            <DialogHeader>
                <DialogTitle>Cookie Preferences</DialogTitle>
                <DialogDescription>
                    Manage which types of cookies you allow on this site.
                </DialogDescription>
            </DialogHeader>
            <div class="space-y-4 py-4">
                <!-- Necessary -->
                <div
                    class="flex items-center justify-between rounded-lg border p-4"
                >
                    <div>
                        <div class="text-sm font-medium">Necessary</div>
                        <div class="text-xs text-muted-foreground">
                            Required for the website to function.
                        </div>
                    </div>
                    <div
                        class="rounded-full bg-primary/20 px-3 py-1 text-xs font-medium text-primary"
                    >
                        Always on
                    </div>
                </div>
                <!-- Analytics -->
                <label
                    class="flex cursor-pointer items-center justify-between rounded-lg border p-4"
                >
                    <div>
                        <div class="text-sm font-medium">Analytics</div>
                        <div class="text-xs text-muted-foreground">
                            Helps us understand how you use our site.
                        </div>
                    </div>
                    <button
                        role="switch"
                        :aria-checked="analytics"
                        class="relative inline-flex h-6 w-11 shrink-0 rounded-full border-2 border-transparent transition-colors focus-visible:ring-2 focus-visible:ring-ring focus-visible:outline-none"
                        :class="analytics ? 'bg-primary' : 'bg-input'"
                        @click="analytics = !analytics"
                    >
                        <span
                            class="pointer-events-none block size-5 rounded-full bg-background shadow-lg ring-0 transition-transform"
                            :class="
                                analytics ? 'translate-x-5' : 'translate-x-0'
                            "
                        />
                    </button>
                </label>
                <!-- Marketing -->
                <label
                    class="flex cursor-pointer items-center justify-between rounded-lg border p-4"
                >
                    <div>
                        <div class="text-sm font-medium">Marketing</div>
                        <div class="text-xs text-muted-foreground">
                            Used to show relevant advertisements.
                        </div>
                    </div>
                    <button
                        role="switch"
                        :aria-checked="marketing"
                        class="relative inline-flex h-6 w-11 shrink-0 rounded-full border-2 border-transparent transition-colors focus-visible:ring-2 focus-visible:ring-ring focus-visible:outline-none"
                        :class="marketing ? 'bg-primary' : 'bg-input'"
                        @click="marketing = !marketing"
                    >
                        <span
                            class="pointer-events-none block size-5 rounded-full bg-background shadow-lg ring-0 transition-transform"
                            :class="
                                marketing ? 'translate-x-5' : 'translate-x-0'
                            "
                        />
                    </button>
                </label>
            </div>
            <DialogFooter>
                <Button @click="savePreferences">Save Preferences</Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
