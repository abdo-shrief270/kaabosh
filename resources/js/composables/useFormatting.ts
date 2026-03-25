import { useLocale } from './useLocale';

export function useFormatting() {
    const { locale } = useLocale();

    const localeMap: Record<string, string> = { en: 'en-US', ar: 'ar-SA', fr: 'fr-FR' };

    function formatDate(date: string | Date, options?: Intl.DateTimeFormatOptions): string {
        const d = typeof date === 'string' ? new Date(date) : date;
        return d.toLocaleDateString(localeMap[locale.value] ?? 'en-US', options ?? { year: 'numeric', month: 'short', day: 'numeric' });
    }

    function formatNumber(num: number, options?: Intl.NumberFormatOptions): string {
        return num.toLocaleString(localeMap[locale.value] ?? 'en-US', options);
    }

    return { formatDate, formatNumber };
}
