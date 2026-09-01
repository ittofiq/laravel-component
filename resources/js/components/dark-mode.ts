interface DarkModeState {
    isDark: boolean;
    _shortcutPrefix: string | null;
    _shortcutTimer: number | null;
    init(): void;
    toggle(): void;
    apply(): void;
    handleShortcut(e: KeyboardEvent): void;
}

export default function darkMode(): DarkModeState {
    return {
        isDark: localStorage.getItem('theme') === 'dark' ||
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
        _shortcutPrefix: null,
        _shortcutTimer: null,

        init() {
            this.apply();
        },

        toggle() {
            this.isDark = !this.isDark;
            this.apply();
        },

        apply() {
            document.documentElement.classList.toggle('dark', this.isDark);
            localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
        },

        handleShortcut(e: KeyboardEvent) {
            // Ignore if user is typing in an input/textarea/select
            const activeEl = document.activeElement as HTMLElement | null;
            const tag = activeEl?.tagName?.toLowerCase();
            if (tag === 'input' || tag === 'textarea' || tag === 'select' || activeEl?.isContentEditable) {
                return;
            }

            const key = e.key.toLowerCase();
            const isMac = (navigator.platform || '').toLowerCase().includes('mac');
            const mod = isMac ? e.metaKey : e.ctrlKey;

            // D — Toggle Dark Mode
            if (key === 'd' && !mod && !e.shiftKey) {
                e.preventDefault();
                this.toggle();
                return;
            }

            // ? — Show Shortcuts Help
            if (key === '?' && !mod) {
                e.preventDefault();
                (this as unknown as { $dispatch: (event: string) => void }).$dispatch('open-shortcuts');
                return;
            }

            // G + key — Go to page (two-key sequence)
            if (key === 'g' && !mod && !e.shiftKey) {
                this._shortcutPrefix = 'g';
                clearTimeout(this._shortcutTimer ?? undefined);
                this._shortcutTimer = window.setTimeout(() => { this._shortcutPrefix = null; }, 1500);
                return;
            }

            if (this._shortcutPrefix === 'g') {
                e.preventDefault();
                this._shortcutPrefix = null;
                if (this._shortcutTimer) clearTimeout(this._shortcutTimer);

                const routes: Record<string, string> = {
                    'h': '/',
                    'c': '/components',
                    'u': '/components/ui',
                    'f': '/components/form',
                    'd': '/components/data',
                    'n': '/components/navigation',
                    'o': '/components/overlay',
                    'b': '/components/feedback',
                    'l': '/components/layout',
                    'm': '/components/custom',
                };

                if (routes[key]) {
                    window.location.href = routes[key];
                }
            }
        }
    };
}