export default function darkMode() {
    return {
        isDark: localStorage.getItem('theme') === 'dark' ||
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),

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

        handleShortcut(e) {
            // Ignore if user is typing in an input/textarea/select
            const tag = document.activeElement?.tagName?.toLowerCase();
            if (tag === 'input' || tag === 'textarea' || tag === 'select' || document.activeElement?.isContentEditable) {
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
                this.$dispatch('open-shortcuts');
                return;
            }

            // G + key — Go to page (two-key sequence)
            if (key === 'g' && !mod && !e.shiftKey) {
                this._shortcutPrefix = 'g';
                // Auto-clear prefix after 1.5s
                clearTimeout(this._shortcutTimer);
                const self = this;
                this._shortcutTimer = setTimeout(() => { self._shortcutPrefix = null; }, 1500);
                return;
            }

            if (this._shortcutPrefix === 'g') {
                e.preventDefault();
                this._shortcutPrefix = null;
                clearTimeout(this._shortcutTimer);

                const routes = {
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