export default function multiSelectComponent(uniqueId, allOptions, isDisabled, maxTags) {
    return {
        uniqueId,
        allOptions,
        isDisabled,
        maxTags,
        selectedValues: [],
        searchQuery: '',
        filteredOptions: allOptions,
        isOpen: false,
        highlightedIdx: -1,

        init() {
            this.filteredOptions = { ...this.allOptions };
        },

        get selectedValuesJson() {
            return JSON.stringify(this.selectedValues);
        },

        set selectedValuesJson(val) {
            try { this.selectedValues = JSON.parse(val) || []; } catch (e) { this.selectedValues = []; }
        },

        toggleTag(value) {
            if (this.isDisabled) return;
            if (this.maxTags && this.selectedValues.length >= this.maxTags && !this.selectedValues.includes(value)) return;
            const index = this.selectedValues.indexOf(value);
            if (index > -1) { this.selectedValues.splice(index, 1); } else { this.selectedValues.push(value); }
        },

        removeTag(value) {
            if (this.isDisabled) return;
            const index = this.selectedValues.indexOf(value);
            if (index > -1) this.selectedValues.splice(index, 1);
        },

        clearAll() {
            if (this.isDisabled) return;
            this.selectedValues = [];
        },

        toggleSelectAll() {
            if (this.isDisabled) return;
            const allKeys = Object.keys(this.allOptions);
            this.selectedValues = this.selectedValues.length === allKeys.length ? [] : [...allKeys];
        },

        filterOptions() {
            if (!this.searchQuery.trim()) {
                this.filteredOptions = { ...this.allOptions };
                this.highlightedIdx = -1;
                return;
            }
            const query = this.searchQuery.toLowerCase();
            this.filteredOptions = Object.fromEntries(
                Object.entries(this.allOptions).filter(([value, text]) =>
                    text.toLowerCase().includes(query) || value.toLowerCase().includes(query)
                )
            );
            this.highlightedIdx = 0;
        },

        selectFirstFiltered() {
            const firstKey = Object.keys(this.filteredOptions)[0];
            if (firstKey) { this.toggleTag(firstKey); this.searchQuery = ''; this.filterOptions(); }
        },

        highlightNext() {
            const keys = Object.keys(this.filteredOptions);
            this.highlightedIdx = Math.min(this.highlightedIdx + 1, keys.length - 1);
        },

        highlightPrev() {
            this.highlightedIdx = Math.max(this.highlightedIdx - 1, -1);
        },

        getOptionText(value) {
            return this.allOptions[value] || value;
        }
    };
}