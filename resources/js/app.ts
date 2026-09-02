import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import fileUploadComponent from './components/file-upload';
import { toastComponent, toastContainerComponent, showToast } from './components/toast';
import darkMode from './components/dark-mode';
import chartComponent from './components/chart';

// ============================================================
// Type Definitions
// ============================================================

interface FormWizardState {
    currentStep: number;
    total: number;
    steps: unknown[];
    next(): void;
    prev(): void;
    goTo(step: number): void;
}

interface ContextMenuState {
    items: ContextMenuItem[];
    show: boolean;
    x: number;
    y: number;
    openMenu(event: MouseEvent): void;
    handleClick(item: ContextMenuItem): void;
}

interface RatingInputState {
    rating: number;
    hoverRating: number;
    max: number;
    disabled: boolean;
    setRating(value: number): void;
}

interface CurrencyInputState {
    display: string;
    rawValue: number;
    allowOnlyNumbers(e: KeyboardEvent): void;
    format(): void;
    clear(): void;
}

interface CountryInfo {
    code: string;
    flag: string;
    name: string;
}

interface PhoneInputState {
    open: boolean;
    countries: Record<string, CountryInfo>;
    selectedKey: string;
    selectedCountry: CountryInfo;
    phoneNumber: string;
    allowOnlyNumbers(e: KeyboardEvent): void;
    selectCountry(key: string): void;
}

interface CookieConsentState {
    show: boolean;
    accept(): void;
    decline(): void;
}

interface DragDropItem {
    label: string;
}

interface DragDropListState {
    items: DragDropItem[];
    draggingIndex: number | null;
    dragOverIndex: number | null;
    dragStart(e: DragEvent, index: number): void;
    dragOver(e: DragEvent, index: number): void;
    dragEnter(e: DragEvent, index: number): void;
    dragLeave(e: DragEvent, index: number): void;
    drop(e: DragEvent, index: number): void;
    dragEnd(): void;
}

interface RangeSliderState {
    value: number;
    minVal: number;
    maxVal: number;
    gap: number;
    limit: number;
    limitMax: number;
    $refs: { minHandle?: HTMLInputElement; maxHandle?: HTMLInputElement };
    init(): void;
    setMinVal(e: Event): void;
    setMaxVal(e: Event): void;
}

interface CommandPaletteState {
    open: boolean;
    query: string;
    filteredItems: CommandPaletteItem[];
    highlighted: number;
    isMac: boolean;
    items: CommandPaletteItem[];
    filter(): void;
    select(item: CommandPaletteItem): void;
}

interface TreeNodeState {
    label: string;
    children?: TreeNodeState[];
    expanded?: boolean;
    depth?: number;
}

interface TreeViewState {
    rootItems: TreeNodeState[];
    flatNodes: TreeNodeState[];
    init(): void;
    flatten(): void;
    _walk(nodes: TreeNodeState[], depth: number): void;
    toggle(node: TreeNodeState): void;
}

interface CalendarState {
    year: number;
    month: number;
    events: CalendarEvent[];
    days: CalendarDay[];
    selectedDate: string;
    selectedEvents: CalendarEvent[];
    monthNames: string[];
    readonly monthName: string;
    init(): void;
    loadEvents(eventsData: CalendarEvent[]): void;
    generateCalendar(): void;
    selectDay(day: CalendarDay): void;
    prevMonth(): void;
    nextMonth(): void;
}

// ============================================================
// Register all component functions globally for Alpine x-data
// ============================================================

window.fileUploadComponent = fileUploadComponent;
window.toastComponent = toastComponent;
window.toastContainerComponent = toastContainerComponent;
window.showToast = showToast;
window.darkMode = darkMode;
window.chartComponent = chartComponent;

// Form Wizard
window.formWizard = function(
    initialStep: number,
    totalSteps: number,
    wizardSteps: unknown[]
): FormWizardState {
    return {
        currentStep: initialStep,
        total: totalSteps,
        steps: wizardSteps || [],
        next() { if (this.currentStep < this.total) this.currentStep++; },
        prev() { if (this.currentStep > 1) this.currentStep--; },
        goTo(step: number) { if (step >= 1 && step <= this.total) this.currentStep = step; }
    };
};

// Start Alpine.js
window.Alpine = Alpine;

// OS detection helper
function getModKey(): string {
    const platform = (navigator.platform || '').toLowerCase();
    if (platform.includes('win') || platform.includes('linux')) return 'Ctrl';
    return '⌘';
}
window.getModKey = getModKey;

// Context Menu
window.contextMenu = function(items: ContextMenuItem[]): ContextMenuState {
    const isMac = (navigator.platform || '').toLowerCase().includes('mac');
    const processedItems = (items || []).map(item => {
        if (item.shortcut && !isMac) {
            return {
                ...item,
                shortcut: item.shortcut.replace(/⌘/g, 'Ctrl+').replace(/⌥/g, 'Alt+').replace(/⌫/g, 'Backspace'),
            };
        }
        return item;
    });

    return {
        items: processedItems,
        show: false,
        x: 0,
        y: 0,

        openMenu(event: MouseEvent) {
            this.x = event.clientX;
            this.y = event.clientY;
            this.show = true;
            const self = this;
            (this as unknown as { $nextTick: (cb: () => void) => void }).$nextTick(() => {
                const el = (self as unknown as { $el: HTMLElement }).$el;
                const menu = el.querySelector<HTMLElement>('[x-show="show"]');
                if (menu) {
                    const rect = menu.getBoundingClientRect();
                    if (rect.right > window.innerWidth) self.x = window.innerWidth - rect.width - 10;
                    if (rect.bottom > window.innerHeight) self.y = window.innerHeight - rect.height - 10;
                }
            });
        },

        handleClick(item: ContextMenuItem) {
            if (item.action) {
                item.action();
            }
        }
    };
};

// Rating Input
window.ratingInput = function(initial: number, maxStars: number, isDisabled: boolean): RatingInputState {
    return {
        rating: Math.floor(initial) || 0,
        hoverRating: 0,
        max: maxStars,
        disabled: isDisabled,
        setRating(value: number) {
            if (this.disabled) return;
            this.rating = this.rating === value ? 0 : value;
        }
    };
};

// Currency Input
window.currencyInput = function(initial: string, locale: string, _symbol: string): CurrencyInputState {
    return {
        display: initial || '',
        rawValue: initial ? parseInt(initial.replace(/[^0-9]/g, ''), 10) : 0,

        allowOnlyNumbers(e: KeyboardEvent) {
            const allowed = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Home', 'End'];
            if (allowed.includes(e.key)) return;
            if (e.ctrlKey || e.metaKey) return;
            if (!/^[0-9]$/.test(e.key)) {
                e.preventDefault();
            }
        },

        format() {
            const raw = this.display.replace(/[^0-9]/g, '');
            this.rawValue = parseInt(raw, 10) || 0;
            if (this.rawValue > 0) {
                this.display = new Intl.NumberFormat(locale, {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(this.rawValue);
            }
        },

        clear() {
            this.display = '';
            this.rawValue = 0;
        }
    };
};

// Phone Input
window.phoneInput = function(
    _uniqueId: string,
    countries: Record<string, CountryInfo>,
    defaultKey: string
): PhoneInputState {
    return {
        open: false,
        countries,
        selectedKey: defaultKey,
        selectedCountry: countries[defaultKey] || { code: '+62', flag: '🇮🇩', name: 'Indonesia' },
        phoneNumber: '',

        allowOnlyNumbers(e: KeyboardEvent) {
            const allowed = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Home', 'End'];
            if (allowed.includes(e.key)) return;
            if (e.ctrlKey || e.metaKey) return;
            if (!/^[0-9]$/.test(e.key)) e.preventDefault();
        },

        selectCountry(key: string) {
            this.selectedKey = key;
            this.selectedCountry = this.countries[key];
        }
    };
};

// Cookie Consent
window.cookieConsent = function(): CookieConsentState {
    return {
        show: !localStorage.getItem('cookieConsent'),

        accept() {
            localStorage.setItem('cookieConsent', 'accepted');
            this.show = false;
        },
        decline() {
            localStorage.setItem('cookieConsent', 'declined');
            this.show = false;
        }
    };
};

// Drag & Drop List
window.dragDropList = function(items: DragDropItem[]): DragDropListState {
    return {
        items: items || [],
        draggingIndex: null,
        dragOverIndex: null,

        dragStart(e: DragEvent, index: number) {
            this.draggingIndex = index;
            if (e.dataTransfer) {
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/plain', '');
            }
        },
        dragOver(_e: DragEvent, index: number) {
            this.dragOverIndex = index;
        },
        dragEnter(_e: DragEvent, index: number) {
            this.dragOverIndex = index;
        },
        dragLeave(_e: DragEvent, index: number) {
            if (this.dragOverIndex === index) this.dragOverIndex = null;
        },
        drop(_e: DragEvent, index: number) {
            if (this.draggingIndex === null || this.draggingIndex === index) return;
            const dragged = this.items.splice(this.draggingIndex, 1)[0];
            this.items.splice(index, 0, dragged);
            this.draggingIndex = null;
            this.dragOverIndex = null;
        },
        dragEnd() {
            this.draggingIndex = null;
            this.dragOverIndex = null;
        }
    };
};

// Range Slider
window.rangeSlider = function(
    initial: number,
    min: number,
    max: number,
    step: number,
    _isDual: boolean,
    initialMin: number,
    initialMax: number
): RangeSliderState {
    return {
        value: Math.floor(initial),
        minVal: Math.floor(initialMin),
        maxVal: Math.floor(initialMax),
        gap: Math.floor(step) || 1,
        limit: Math.floor(min),
        limitMax: Math.floor(max),
        $refs: {},

        init() {
            if (this.$refs.minHandle) this.$refs.minHandle.value = String(this.minVal);
            if (this.$refs.maxHandle) this.$refs.maxHandle.value = String(this.maxVal);
        },

        setMinVal(e: Event) {
            const target = e.target as HTMLInputElement;
            let val = parseInt(target.value, 10);
            if (val < this.limit) val = this.limit;
            if (val > this.maxVal - this.gap) val = this.maxVal - this.gap;
            this.minVal = val;
            target.value = String(val);
        },
        setMaxVal(e: Event) {
            const target = e.target as HTMLInputElement;
            let val = parseInt(target.value, 10);
            if (val > this.limitMax) val = this.limitMax;
            if (val < this.minVal + this.gap) val = this.minVal + this.gap;
            this.maxVal = val;
            target.value = String(val);
        }
    };
};

// Command Palette
window.commandPalette = function(items: CommandPaletteItem[]): CommandPaletteState {
    return {
        open: false,
        query: '',
        filteredItems: items || [],
        highlighted: 0,
        isMac: (navigator.platform || '').toLowerCase().includes('mac'),
        items: items || [],

        filter() {
            const q = this.query.toLowerCase().trim();
            if (!q) {
                this.filteredItems = this.items || [];
            } else {
                this.filteredItems = (this.items || []).filter(item =>
                    item.label.toLowerCase().includes(q) ||
                    (item.description && item.description.toLowerCase().includes(q))
                );
            }
            this.highlighted = 0;
        },

        select(item: CommandPaletteItem) {
            if (item.href) {
                window.location.href = item.href;
            } else if (item.action) {
                item.action();
            }
        }
    };
};

// Tree View Component (unlimited levels)
window.treeView = function(items: TreeNodeState[]): TreeViewState {
    return {
        rootItems: items,
        flatNodes: [],

        init() {
            this.flatten();
        },

        flatten() {
            this.flatNodes = [];
            this._walk(this.rootItems, 0);
        },

        _walk(nodes: TreeNodeState[], depth: number) {
            nodes.forEach(node => {
                node.depth = depth;
                if (node.expanded === undefined) node.expanded = false;
                this.flatNodes.push(node);
                if (node.expanded && node.children && node.children.length > 0) {
                    this._walk(node.children, depth + 1);
                }
            });
        },

        toggle(node: TreeNodeState) {
            if (node.children && node.children.length > 0) {
                node.expanded = !node.expanded;
            }
            this.flatten();
        }
    };
};

// Calendar Component
window.calendarComponent = function(year: number, month: number): CalendarState {
    return {
        year,
        month,
        events: [],
        days: [],
        selectedDate: '',
        selectedEvents: [],
        monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],

        get monthName() {
            return this.monthNames[this.month - 1];
        },

        init() {
            this.generateCalendar();
        },

        loadEvents(eventsData: CalendarEvent[]) {
            this.events = eventsData || [];
            this.generateCalendar();
        },

        generateCalendar() {
            const firstDay = new Date(this.year, this.month - 1, 1);
            const lastDay = new Date(this.year, this.month, 0);
            const startDay = firstDay.getDay();
            const totalDays = lastDay.getDate();
            const prevMonthDays = new Date(this.year, this.month - 1, 0).getDate();
            const today = new Date();
            this.days = [];

            for (let i = startDay - 1; i >= 0; i--) {
                this.days.push({ day: prevMonthDays - i, currentMonth: false, isToday: false, events: [] });
            }
            for (let d = 1; d <= totalDays; d++) {
                const dateStr = `${this.year}-${String(this.month).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                const isToday = d === today.getDate() && this.month === today.getMonth() + 1 && this.year === today.getFullYear();
                const dayEvents = (this.events || []).filter(e => e.date === dateStr);
                this.days.push({ day: d, currentMonth: true, isToday, date: dateStr, events: dayEvents });
            }
            const remaining = 42 - this.days.length;
            for (let i = 1; i <= remaining; i++) {
                this.days.push({ day: i, currentMonth: false, isToday: false, events: [] });
            }
            this.selectedEvents = [];
            this.selectedDate = '';
        },

        selectDay(day: CalendarDay) {
            if (!day.currentMonth) return;
            this.selectedDate = day.date || '';
            this.selectedEvents = day.events || [];
        },

        prevMonth() {
            this.month--;
            if (this.month < 1) { this.month = 12; this.year--; }
            this.selectedDate = '';
            this.selectedEvents = [];
            this.generateCalendar();
        },

        nextMonth() {
            this.month++;
            if (this.month > 12) { this.month = 1; this.year++; }
            this.selectedDate = '';
            this.selectedEvents = [];
            this.generateCalendar();
        }
    };
};

// Global copy code utility
window.copyCode = function(btn: HTMLElement): void {
    const code = btn.getAttribute('data-code');
    if (!code) return;

    // Decode HTML entities
    const txt = document.createElement('textarea');
    txt.innerHTML = code;
    const decoded = txt.value;

    navigator.clipboard.writeText(decoded).then(() => {
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '✅ Copied!';
        btn.classList.add('bg-green-100', 'dark:bg-green-900/30', 'text-green-700', 'dark:text-green-300');
        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.classList.remove('bg-green-100', 'dark:bg-green-900/30', 'text-green-700', 'dark:text-green-300');
        }, 1500);
    }).catch(() => {
        // Fallback for older browsers
        const ta = document.createElement('textarea');
        ta.value = decoded;
        ta.style.position = 'fixed';
        ta.style.opacity = '0';
        document.body.appendChild(ta);
        ta.select();
        document.execCommand('copy');
        document.body.removeChild(ta);
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '✅ Copied!';
        setTimeout(() => { btn.innerHTML = originalHTML; }, 1500);
    });
};

// Global code snippet generator (for component explorers/playgrounds)
window.codeSnippet = function(
    component: string,
    attrs: Record<string, string | number | boolean>,
    children = '...'
): string {
    const attrStr = Object.entries(attrs)
        .filter(([, v]) => v !== false && v !== '' && v !== null && v !== undefined)
        .map(([k, v]) => (v === true ? k : `${k}="${v}"`))
        .join(' ');
    return `<x-${component}${attrStr ? ' ' + attrStr : ''}>${children}</x-${component}>`;
};

Alpine.plugin(collapse);

Alpine.store('sidebar', { collapsed: localStorage.getItem('sidebarCollapsed') === 'true' });

Alpine.effect(() => {
    localStorage.setItem('sidebarCollapsed', Alpine.store('sidebar').collapsed ? 'true' : 'false');
});

Alpine.start();