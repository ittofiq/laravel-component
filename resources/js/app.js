import Alpine from 'alpinejs';
import multiSelectComponent from './components/multi-select';
import selectComponent from './components/select';
import fileUploadComponent from './components/file-upload';
import { toastComponent, toastContainerComponent, showToast } from './components/toast';
import darkMode from './components/dark-mode';
import chartComponent from './components/chart';

// Register all component functions globally for Alpine x-data
window.multiSelectComponent = multiSelectComponent;
window.selectComponent = selectComponent;
window.fileUploadComponent = fileUploadComponent;
window.toastComponent = toastComponent;
window.toastContainerComponent = toastContainerComponent;
window.showToast = showToast;
window.darkMode = darkMode;
window.chartComponent = chartComponent;

// Form Wizard
window.formWizard = function(initialStep, totalSteps, wizardSteps) {
    return {
        currentStep: initialStep,
        total: totalSteps,
        steps: wizardSteps || [],
        next() { if (this.currentStep < this.total) this.currentStep++; },
        prev() { if (this.currentStep > 1) this.currentStep--; },
        goTo(step) { if (step >= 1 && step <= this.total) this.currentStep = step; }
    };
};

// Start Alpine.js
window.Alpine = Alpine;
// OS detection helper
function getModKey() {
    var platform = (navigator.platform || '').toLowerCase();
    if (platform.includes('win') || platform.includes('linux')) return 'Ctrl';
    return '⌘';
}
window.getModKey = getModKey;

// Context Menu
window.contextMenu = function(items) {
    var isMac = (navigator.platform || '').toLowerCase().includes('mac');
    var processedItems = (items || []).map(function(item) {
        if (item.shortcut && !isMac) {
            item.shortcut = item.shortcut.replace(/⌘/g, 'Ctrl+').replace(/⌥/g, 'Alt+').replace(/⌫/g, 'Backspace');
        }
        return item;
    });
    return {
        items: processedItems,
        show: false,
        x: 0,
        y: 0,
        
        openMenu(event) {
            this.x = event.clientX;
            this.y = event.clientY;
            this.show = true;
            var self = this;
            this.$nextTick(function() {
                const menu = self.$el.querySelector('[x-show="show"]');
                if (menu) {
                    const rect = menu.getBoundingClientRect();
                    if (rect.right > window.innerWidth) self.x = window.innerWidth - rect.width - 10;
                    if (rect.bottom > window.innerHeight) self.y = window.innerHeight - rect.height - 10;
                }
            });
        },

        handleClick(item) {
            if (item.action) {
                item.action();
            }
        }
    };
};

// Rating Input
window.ratingInput = function(initial, maxStars, isDisabled) {
    return {
        rating: parseInt(initial) || 0,
        hoverRating: 0,
        max: maxStars,
        disabled: isDisabled,
        setRating: function(value) {
            if (this.disabled) return;
            this.rating = this.rating === value ? 0 : value;
        }
    };
};

// Currency Input
window.currencyInput = function(initial, locale, symbol) {
    return {
        display: initial || '',
        rawValue: initial ? parseInt(initial.replace(/[^0-9]/g, '')) : 0,

        allowOnlyNumbers(e) {
            var allowed = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Home', 'End'];
            if (allowed.includes(e.key)) return;
            if (e.ctrlKey || e.metaKey) return;
            if (!/^[0-9]$/.test(e.key)) {
                e.preventDefault();
            }
        },

        format() {
            var raw = this.display.replace(/[^0-9]/g, '');
            this.rawValue = parseInt(raw) || 0;
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
window.phoneInput = function(uniqueId, countries, defaultKey) {
    return {
        open: false,
        countries: countries,
        selectedKey: defaultKey,
        selectedCountry: countries[defaultKey] || { code: '+62', flag: '🇮🇩', name: 'Indonesia' },
        phoneNumber: '',

        allowOnlyNumbers(e) {
            var allowed = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Home', 'End'];
            if (allowed.includes(e.key)) return;
            if (e.ctrlKey || e.metaKey) return;
            if (!/^[0-9]$/.test(e.key)) e.preventDefault();
        },

        selectCountry(key) {
            this.selectedKey = key;
            this.selectedCountry = this.countries[key];
        }
    };
};

// Cookie Consent
window.cookieConsent = function() {
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
window.dragDropList = function(items) {
    return {
        items: items || [],
        draggingIndex: null,
        dragOverIndex: null,

        dragStart(e, index) {
            this.draggingIndex = index;
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', '');
        },
        dragOver(e, index) {
            this.dragOverIndex = index;
        },
        dragEnter(e, index) {
            this.dragOverIndex = index;
        },
        dragLeave(e, index) {
            if (this.dragOverIndex === index) this.dragOverIndex = null;
        },
        drop(e, index) {
            if (this.draggingIndex === null || this.draggingIndex === index) return;
            var dragged = this.items.splice(this.draggingIndex, 1)[0];
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
window.rangeSlider = function(initial, min, max, step, isDual, initialMin, initialMax) {
    return {
        value: parseInt(initial),
        minVal: parseInt(initialMin),
        maxVal: parseInt(initialMax),
        gap: parseInt(step) || 1,
        limit: parseInt(min),
        limitMax: parseInt(max),

        init() {
            if (this.$refs.minHandle) this.$refs.minHandle.value = this.minVal;
            if (this.$refs.maxHandle) this.$refs.maxHandle.value = this.maxVal;
        },

        setMinVal(e) {
            var val = parseInt(e.target.value);
            if (val < this.limit) val = this.limit;
            if (val > this.maxVal - this.gap) val = this.maxVal - this.gap;
            this.minVal = val;
            e.target.value = val;
        },
        setMaxVal(e) {
            var val = parseInt(e.target.value);
            if (val > this.limitMax) val = this.limitMax;
            if (val < this.minVal + this.gap) val = this.minVal + this.gap;
            this.maxVal = val;
            e.target.value = val;
        }
    };
};

// Command Palette
window.commandPalette = function(items) {
    return {
        open: false,
        query: '',
        filteredItems: items || [],
        highlighted: 0,
        isMac: (navigator.platform || '').toLowerCase().includes('mac'),
        
        filter() {
            const q = this.query.toLowerCase().trim();
            if (!q) {
                this.filteredItems = this.items || [];
            } else {
                this.filteredItems = (this.items || []).filter(function(item) {
                    return item.label.toLowerCase().includes(q) ||
                           (item.description && item.description.toLowerCase().includes(q));
                });
            }
            this.highlighted = 0;
        },

        select(item) {
            if (item.href) {
                window.location.href = item.href;
            } else if (item.action) {
                item.action();
            }
        }
    };
};

// Tree View Component (unlimited levels)
window.treeView = function(items) {
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

        _walk(nodes, depth) {
            nodes.forEach(node => {
                node.depth = depth;
                if (node.expanded === undefined) node.expanded = false;
                this.flatNodes.push(node);
                if (node.expanded && node.children && node.children.length > 0) {
                    this._walk(node.children, depth + 1);
                }
            });
        },

        toggle(node) {
            if (node.children && node.children.length > 0) {
                node.expanded = !node.expanded;
            }
            this.flatten();
        }
    };
};

// Calendar Component
window.calendarComponent = function(year, month) {
    return {
        year: year,
        month: month,
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

        loadEvents(eventsData) {
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

        selectDay(day) {
            if (!day.currentMonth) return;
            this.selectedDate = day.date;
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

Alpine.start();