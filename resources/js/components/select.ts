interface OptionsMap {
    [key: string]: string;
}

interface SelectState {
    uniqueId: string;
    allOptions: OptionsMap;
    isDisabled: boolean;
    selectedValue: string;
    searchQuery: string;
    filteredOptions: OptionsMap;
    isOpen: boolean;
    searchFocused: boolean;
    highlightedIdx: number;
    init(): void;
    getDisplayText(): string;
    selectOption(value: string): void;
    clearSelection(): void;
    filterOptions(): void;
    highlightNext(): void;
    highlightPrev(): void;
    selectHighlighted(): void;
}

export default function selectComponent(
    uniqueId: string,
    allOptions: OptionsMap,
    isDisabled: boolean
): SelectState {
    return {
        uniqueId, allOptions, isDisabled,
        selectedValue: '',
        searchQuery: '',
        filteredOptions: allOptions,
        isOpen: false,
        searchFocused: false,
        highlightedIdx: -1,

        init() { this.filteredOptions = { ...this.allOptions }; },

        getDisplayText() { return this.allOptions[this.selectedValue] || 'Pilih opsi...'; },

        selectOption(value: string) {
            this.selectedValue = value; this.isOpen = false;
            this.searchQuery = ''; this.filteredOptions = { ...this.allOptions };
        },

        clearSelection() { this.selectedValue = ''; },

        filterOptions() {
            if (!this.searchQuery.trim()) { this.filteredOptions = { ...this.allOptions }; return; }
            const query = this.searchQuery.toLowerCase();
            this.filteredOptions = Object.fromEntries(
                Object.entries(this.allOptions).filter(([value, text]) =>
                    text.toLowerCase().includes(query) || value.toLowerCase().includes(query)
                )
            );
            this.highlightedIdx = 0;
        },

        highlightNext() {
            const keys = Object.keys(this.filteredOptions);
            this.highlightedIdx = Math.min(this.highlightedIdx + 1, keys.length - 1);
        },

        highlightPrev() { this.highlightedIdx = Math.max(this.highlightedIdx - 1, -1); },

        selectHighlighted() {
            const keys = Object.keys(this.filteredOptions);
            if (this.highlightedIdx >= 0 && this.highlightedIdx < keys.length) {
                this.selectOption(keys[this.highlightedIdx]);
            }
        }
    };
}