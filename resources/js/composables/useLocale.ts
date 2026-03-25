import { ref, computed, watch, provide, inject, type InjectionKey, type Ref } from 'vue';
import en from '@/locales/en';
import ar from '@/locales/ar';
import fr from '@/locales/fr';

export type Locale = 'en' | 'ar' | 'fr';
export type TranslationMessages = typeof en;

const messages: Record<Locale, TranslationMessages> = { en, ar, fr };

const LOCALE_KEY = 'kaabosh-locale';

const localeInjectionKey = Symbol('locale') as InjectionKey<{
    locale: Ref<Locale>;
    t: (key: string, params?: Record<string, string>) => string;
    setLocale: (l: Locale) => void;
    dir: Ref<'ltr' | 'rtl'>;
    isRtl: Ref<boolean>;
}>;

function getNestedValue(obj: any, path: string): string | undefined {
    return path.split('.').reduce((acc, part) => acc?.[part], obj);
}

export function createLocale() {
    const stored = (typeof localStorage !== 'undefined' ? localStorage.getItem(LOCALE_KEY) : null) as Locale | null;
    const locale = ref<Locale>(stored === 'ar' ? 'ar' : stored === 'fr' ? 'fr' : 'en');

    const dir = computed(() => (locale.value === 'ar' ? 'rtl' : 'ltr'));
    const isRtl = computed(() => locale.value === 'ar');

    function t(key: string, params?: Record<string, string>): string {
        let value = getNestedValue(messages[locale.value], key)
            ?? getNestedValue(messages.en, key)
            ?? key;
        if (params) {
            for (const [k, v] of Object.entries(params)) {
                value = value.replace(new RegExp(`\\{${k}\\}`, 'g'), v);
            }
        }
        return value;
    }

    function setLocale(l: Locale) {
        locale.value = l;
        localStorage.setItem(LOCALE_KEY, l);
        document.documentElement.setAttribute('dir', l === 'ar' ? 'rtl' : 'ltr');
        document.documentElement.setAttribute('lang', l);
    }

    watch(locale, (l) => {
        document.documentElement.setAttribute('dir', l === 'ar' ? 'rtl' : 'ltr');
        document.documentElement.setAttribute('lang', l);
    }, { immediate: true });

    const api = { locale, t, setLocale, dir, isRtl };

    function provideLocale() {
        provide(localeInjectionKey, api);
    }

    return { ...api, provideLocale };
}

export function useLocale() {
    const injected = inject(localeInjectionKey);
    if (!injected) {
        throw new Error('useLocale() must be used within a component tree that called provideLocale()');
    }
    return injected;
}
