// Alpine.js type declarations for TypeScript

declare module 'alpinejs' {
    interface Alpine {
        start(): void;
        data(name: string, callback: () => Record<string, unknown>): void;
        store(name: string): unknown;
        plugin(callback: (...args: any[]) => void): this;
    }

    const Alpine: Alpine;
    export default Alpine;
}

declare module '@alpinejs/collapse' {
    const collapse: (Alpine: any) => void;
    export default collapse;
}