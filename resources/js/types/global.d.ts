// Global type declarations for BacaDev component library
// This file is an ambient declaration — types are available globally

// ============================================================
// Shared Interfaces
// ============================================================

interface ToastDetail {
    type?: 'success' | 'error' | 'warning' | 'info';
    title?: string;
    message: string;
    duration?: number;
}

interface CalendarDay {
    day: number;
    currentMonth: boolean;
    isToday: boolean;
    date?: string;
    events: CalendarEvent[];
}

interface CalendarEvent {
    date: string;
    title?: string;
    color?: string;
}

interface CommandPaletteItem {
    id: string;
    label: string;
    description?: string;
    icon?: string;
    shortcut?: string;
    color?: string;
    href?: string;
    action?: () => void;
}

interface TreeNode {
    label: string;
    children?: TreeNode[];
    expanded?: boolean;
    depth?: number;
}

interface ContextMenuItem {
    label: string;
    icon?: string;
    shortcut?: string;
    danger?: boolean;
    divider?: boolean;
    action?: () => void;
}

interface AlpineMagicProperties {
    $el: HTMLElement;
    $refs: Record<string, HTMLElement>;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    $dispatch(event: string, detail?: any): void;
    $nextTick(callback: () => void): Promise<void>;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    $watch(property: string, callback: (value: any) => void): void;
    $data: Record<string, unknown>;
    init(): void;
}

// ============================================================
// Window Augmentation
// ============================================================

interface Window {
    Alpine: import('alpinejs').default;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    fileUploadComponent: (...args: any[]) => any;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    toastComponent: (...args: any[]) => any;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    toastContainerComponent: (...args: any[]) => any;
    showToast: (detail: ToastDetail) => void;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    darkMode: () => any;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    chartComponent: (...args: any[]) => any;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    formWizard: (...args: any[]) => any;
    getModKey: () => string;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    contextMenu: (items: ContextMenuItem[]) => any;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    ratingInput: (...args: any[]) => any;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    currencyInput: (...args: any[]) => any;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    phoneInput: (...args: any[]) => any;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    cookieConsent: () => any;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    dragDropList: (items: Array<{ label: string }>) => any;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    rangeSlider: (...args: any[]) => any;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    commandPalette: (items: CommandPaletteItem[]) => any;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    treeView: (items: TreeNode[]) => any;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    calendarComponent: (year: number, month: number) => any;
    copyCode: (btn: HTMLElement) => void;
}