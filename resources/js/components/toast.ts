// Toast (Standalone) Component
interface ToastState {
    visible: boolean;
    duration: number;
    progressPercent: number;
    timerInterval: number | null;
    remainingTime: number;
    init(): void;
    startAutoDismiss(): void;
    pauseTimer(): void;
    dismiss(): void;
    show(): void;
}

export function toastComponent(initialShow: boolean, duration: number): ToastState {
    return {
        visible: initialShow,
        duration,
        progressPercent: 100,
        timerInterval: null,
        remainingTime: duration,

        init() { if (this.visible && this.duration > 0) this.startAutoDismiss(); },

        startAutoDismiss() {
            const startTime = Date.now();
            const totalDuration = this.remainingTime;
            this.timerInterval = window.setInterval(() => {
                const elapsed = Date.now() - startTime;
                const remaining = totalDuration - elapsed;
                if (remaining <= 0) { this.dismiss(); }
                else { this.progressPercent = Math.round((remaining / totalDuration) * 100); }
            }, 50);
        },

        pauseTimer() { if (this.timerInterval) { clearInterval(this.timerInterval); this.timerInterval = null; } },
        dismiss() { this.pauseTimer(); this.visible = false; },

        show() {
            this.visible = true; this.progressPercent = 100; this.remainingTime = this.duration;
            if (this.duration > 0) this.startAutoDismiss();
        }
    };
}

// Toast Container Component
interface ToastItem {
    id: number;
    type: string;
    title: string | null;
    message: string;
    duration: number;
    visible: boolean;
    progress: number;
    timerInterval: number | null;
}

interface TypeConfig {
    bg: string;
    border: string;
    text: string;
    icon: string;
    progress: string;
}

interface ToastContainerState {
    toasts: ToastItem[];
    counter: number;
    currentPosition: string;
    positionClasses: Record<string, string>;
    typeConfig: Record<string, TypeConfig>;
    getTypeClasses(type: string): string;
    getIcon(type: string): string;
    getProgressClass(type: string): string;
    addToast(detail: ToastDetail): void;
    startTimer(toast: ToastItem): void;
    removeToast(id: number): void;
}

export function toastContainerComponent(initialPosition: string, maxToasts: number): ToastContainerState {
    return {
        toasts: [], counter: 0, currentPosition: initialPosition,

        positionClasses: {
            'top-right': 'top-4 right-4', 'top-left': 'top-4 left-4',
            'bottom-right': 'bottom-4 right-4', 'bottom-left': 'bottom-4 left-4',
            'top-center': 'top-4 left-1/2 -translate-x-1/2', 'bottom-center': 'bottom-4 left-1/2 -translate-x-1/2',
        },

        typeConfig: {
            success: { bg: 'bg-green-50 dark:bg-green-900/30', border: 'border-green-300 dark:border-green-700', text: 'text-green-800 dark:text-green-200', icon: '✅', progress: 'bg-green-500' },
            error: { bg: 'bg-red-50 dark:bg-red-900/30', border: 'border-red-300 dark:border-red-700', text: 'text-red-800 dark:text-red-200', icon: '❌', progress: 'bg-red-500' },
            warning: { bg: 'bg-yellow-50 dark:bg-yellow-900/30', border: 'border-yellow-300 dark:border-yellow-700', text: 'text-yellow-800 dark:text-yellow-200', icon: '⚠️', progress: 'bg-yellow-500' },
            info: { bg: 'bg-blue-50 dark:bg-blue-900/30', border: 'border-blue-300 dark:border-blue-700', text: 'text-blue-800 dark:text-blue-200', icon: 'ℹ️', progress: 'bg-blue-500' },
        },

        getTypeClasses(type: string) { const c = this.typeConfig[type] || this.typeConfig.info; return c.bg + ' ' + c.border + ' ' + c.text; },
        getIcon(type: string) { return (this.typeConfig[type] || this.typeConfig.info).icon; },
        getProgressClass(type: string) { return (this.typeConfig[type] || this.typeConfig.info).progress; },

        addToast(detail: ToastDetail) {
            const id = ++this.counter;
            const duration = detail.duration || 5000;
            const toast: ToastItem = {
                id, type: detail.type || 'info', title: detail.title || null,
                message: detail.message || '', duration, visible: true, progress: 100, timerInterval: null,
            };
            this.toasts.push(toast);
            if (this.toasts.length > maxToasts) {
                const oldest = this.toasts.shift();
                if (oldest && oldest.timerInterval) clearInterval(oldest.timerInterval);
            }
            if (duration > 0) this.startTimer(toast);
        },

        startTimer(toast: ToastItem) {
            const startTime = Date.now();
            const totalDuration = toast.duration;
            toast.timerInterval = window.setInterval(() => {
                const elapsed = Date.now() - startTime;
                const remaining = totalDuration - elapsed;
                if (remaining <= 0) { this.removeToast(toast.id); }
                else { toast.progress = Math.round((remaining / totalDuration) * 100); }
            }, 50);
        },

        removeToast(id: number) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index === -1) return;
            const toast = this.toasts[index];
            if (toast.timerInterval) clearInterval(toast.timerInterval);
            toast.visible = false;
            setTimeout(() => { this.toasts = this.toasts.filter(t => t.id !== id); }, 500);
        }
    };
}

// Global toast dispatcher
export function showToast(detail: ToastDetail): void {
    window.dispatchEvent(new CustomEvent('add-toast', { detail }));
}