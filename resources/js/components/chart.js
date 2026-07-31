import { Chart, registerables } from 'chart.js';

// Register all Chart.js components
Chart.register(...registerables);

export default function chartComponent(config) {
    return {
        chart: null,
        config: config || {},

        init() {
            // Parse config from data attributes
            const type = this.$el.dataset.chartType || this.config.type || 'bar';
            const rawLabels = this.$el.dataset.chartLabels || this.config.labels || '[]';
            const rawDatasets = this.$el.dataset.chartDatasets || this.config.datasets || '[]';
            const rawOptions = this.$el.dataset.chartOptions || this.config.options || '{}';

            const labels = typeof rawLabels === 'string' ? JSON.parse(rawLabels) : rawLabels;
            const datasets = typeof rawDatasets === 'string' ? JSON.parse(rawDatasets) : rawDatasets;
            let options = typeof rawOptions === 'string' ? JSON.parse(rawOptions) : rawOptions;

            // Check dark mode for theme-aware colors
            const isDark = document.documentElement.classList.contains('dark');

            // Default options
            const defaults = {
                responsive: true,
                maintainAspectRatio: false,
                animation: { duration: 1000, easing: 'easeInOutQuart' },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: isDark ? '#9ca3af' : '#6b7280',
                            padding: 16,
                            usePointStyle: true,
                            font: { size: 12 }
                        }
                    },
                    tooltip: {
                        backgroundColor: isDark ? '#1f2937' : '#ffffff',
                        titleColor: isDark ? '#f3f4f6' : '#111827',
                        bodyColor: isDark ? '#d1d5db' : '#374151',
                        borderColor: isDark ? '#374151' : '#e5e7eb',
                        borderWidth: 1,
                        cornerRadius: 8,
                        padding: 12
                    }
                },
                scales: type === 'bar' || type === 'line' ? {
                    x: {
                        grid: { color: isDark ? '#37415140' : '#e5e7eb80' },
                        ticks: { color: isDark ? '#9ca3af' : '#6b7280' }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: isDark ? '#37415140' : '#e5e7eb80' },
                        ticks: { color: isDark ? '#9ca3af' : '#6b7280' }
                    }
                } : {}
            };

            // Merge options
            options = { ...defaults, ...options };

            // Create chart
            this.chart = new Chart(this.$refs.canvas, {
                type: type,
                data: { labels, datasets },
                options: options
            });
        },

        destroy() {
            if (this.chart) {
                this.chart.destroy();
                this.chart = null;
            }
        }
    };
}