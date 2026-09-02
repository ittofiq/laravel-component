import { Chart, registerables, ChartType } from 'chart.js';

// Register all Chart.js components
Chart.register(...registerables);

interface ChartConfig {
    type?: ChartType;
    labels?: string | string[];
    datasets?: string | Array<Record<string, unknown>>;
    options?: string | Record<string, unknown>;
}

interface ChartState extends AlpineMagicProperties {
    chart: Chart | null;
    config: ChartConfig;
    init(): void;
    destroy(): void;
}

export default function chartComponent(config: ChartConfig = {}): ChartState {
    return {
        chart: null,
        config,
        $el: undefined as unknown as HTMLElement,
        $refs: {},
        $dispatch: () => {},
        $nextTick: async () => {},
        $watch: () => {},
        $data: {},

        init() {
            // Guard against re-init: destroy any existing chart before recreating
            this.destroy();

            const el = this.$el as HTMLElement;
            const type = (el.dataset.chartType || this.config.type || 'bar') as ChartType;
            const rawLabels = el.dataset.chartLabels || this.config.labels || '[]';
            const rawDatasets = el.dataset.chartDatasets || this.config.datasets || '[]';
            const rawOptions = el.dataset.chartOptions || this.config.options || '{}';

            const labels: string[] = typeof rawLabels === 'string' ? JSON.parse(rawLabels) : rawLabels;
            const datasets = typeof rawDatasets === 'string' ? JSON.parse(rawDatasets) : rawDatasets;
            let options: Record<string, unknown> = typeof rawOptions === 'string' ? JSON.parse(rawOptions) : rawOptions;

            const isDark = document.documentElement.classList.contains('dark');

            const defaults: Record<string, unknown> = {
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

            options = { ...defaults, ...options };

            // eslint-disable-next-line @typescript-eslint/no-explicit-any
            this.chart = new Chart(this.$refs.canvas as HTMLCanvasElement, {
                type,
                data: { labels, datasets: datasets as any },
                options,
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