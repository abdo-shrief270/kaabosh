<script setup lang="ts">
import GlobalNav from '@/components/website/GlobalNav.vue';
import FooterSection from '@/components/website/FooterSection.vue';
import AnnouncementBar from '@/components/website/AnnouncementBar.vue';
import CookieConsent from '@/components/website/CookieConsent.vue';
import LiveChatBubble from '@/components/website/LiveChatBubble.vue';
import ToastNotification from '@/components/website/ToastNotification.vue';
import { ref, provide } from 'vue';

const cookieConsentRef = ref<InstanceType<typeof CookieConsent> | null>(null);
const toastRef = ref<InstanceType<typeof ToastNotification> | null>(null);

function openCookiePreferences() {
    cookieConsentRef.value?.openPreferences();
}

// Provide toast function globally so any child component can trigger toasts
provide('toast', (type: 'success' | 'error' | 'info', message: string) => {
    toastRef.value?.addToast(type, message);
});
</script>

<template>
    <div class="flex min-h-screen flex-col">
        <AnnouncementBar
            :is-active="true"
            cta-url="/products/forms"
        />
        <GlobalNav />
        <main id="main-content" class="flex-1">
            <slot />
        </main>
        <FooterSection @open-cookie-preferences="openCookiePreferences" />
        <CookieConsent ref="cookieConsentRef" />
        <LiveChatBubble :online="false" />
        <ToastNotification ref="toastRef" />
    </div>
</template>
