// Alpine.js type declarations for TypeScript

declare module 'alpinejs' {
    interface Alpine {
        start(): void;
        data(name: string, callback: () => Record<string, unknown>): void;
        store(name: string): unknown;
    }

    const Alpine: Alpine;
    export default Alpine;
}