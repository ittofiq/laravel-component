{{-- Komponen Full Page Skeleton - Loading placeholder untuk seluruh halaman --}}
@props([
    'loading' => true,
    'layout' => 'dashboard', // dashboard, blog, list
])

<div x-data="{ loading: {{ $loading ? 'true' : 'false' }} }" class="bg-gray-50 dark:bg-gray-900">
    {{-- Toggle Button --}}
    <div class="flex justify-center pt-4 pb-0">
        <button
            @click="loading = !loading"
            class="px-4 py-2 text-sm font-medium rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition"
            x-text="loading ? '📦 Show Content' : '🦴 Show Skeleton'"
        >📦 Show Content</button>
    </div>

    {{-- SKELETON VIEW --}}
    <div x-show="loading" class="min-h-screen">
        @if($layout === 'dashboard')
            {{-- Dashboard Layout Skeleton --}}
            {{-- Navbar --}}
            <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-3">
                <div class="flex items-center justify-between max-w-7xl mx-auto">
                    <div class="flex items-center gap-6">
                        <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-8 w-28"></div>
                        <div class="hidden md:flex gap-4">
                            <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-4 w-16"></div>
                            <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-4 w-16"></div>
                            <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-4 w-16"></div>
                            <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-4 w-20"></div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded-full h-8 w-8"></div>
                        <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded-full h-8 w-8"></div>
                    </div>
                </div>
            </div>

            <div class="flex">
                {{-- Sidebar --}}
                <div class="hidden lg:block w-56 flex-shrink-0 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-[calc(100vh-57px)] p-4">
                    <div class="space-y-1">
                        @for($i = 0; $i < 8; $i++)
                            <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg">
                                <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded w-5 h-5 flex-shrink-0"></div>
                                <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-3.5 flex-1"></div>
                                <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded-full h-4 w-6"></div>
                            </div>
                        @endfor
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="flex-1 p-6 space-y-6">
                    {{-- Page Title --}}
                    <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-8 w-48"></div>

                    {{-- Stats Row --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        @for($i = 0; $i < 4; $i++)
                            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-5">
                                <div class="flex items-center justify-between">
                                    <div class="space-y-2">
                                        <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-3 w-16"></div>
                                        <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-7 w-20"></div>
                                    </div>
                                    <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded-full h-10 w-10"></div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    {{-- Card Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @for($i = 0; $i < 6; $i++)
                            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                                <div class="animate-pulse bg-gray-200 dark:bg-gray-700 h-40"></div>
                                <div class="p-4 space-y-3">
                                    <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-5 w-3/4"></div>
                                    <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-3 w-full"></div>
                                    <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-3 w-5/6"></div>
                                    <div class="flex gap-2 pt-2">
                                        <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded-md h-7 w-16"></div>
                                        <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded-md h-7 w-16"></div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    {{-- Table Skeleton --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                        <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-5 w-32 mb-4"></div>
                        <div class="space-y-2">
                            @for($r = 0; $r < 5; $r++)
                                <div class="flex gap-4 p-3 border-b border-gray-100 dark:border-gray-700/50">
                                    <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-4 w-1/4"></div>
                                    <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-4 w-1/3"></div>
                                    <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-4 w-1/6"></div>
                                    <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-4 w-1/5"></div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

        @elseif($layout === 'blog')
            {{-- Blog Layout Skeleton --}}
            <div class="max-w-4xl mx-auto px-4 py-8 space-y-8">
                <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-10 w-3/4 mx-auto"></div>
                <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-5 w-1/2 mx-auto"></div>
                <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded-lg h-64 w-full"></div>
                <div class="space-y-3">
                    @for($i = 0; $i < 8; $i++)
                        <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-4" style="width: {{ 100 - ($i * 5) }}%"></div>
                    @endfor
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @for($i = 0; $i < 4; $i++)
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <div class="animate-pulse bg-gray-200 dark:bg-gray-700 h-40"></div>
                            <div class="p-4 space-y-2">
                                <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-5 w-3/4"></div>
                                <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-3 w-full"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

        @else
            {{-- List Layout Skeleton --}}
            <div class="max-w-3xl mx-auto px-4 py-8 space-y-4">
                <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-8 w-48 mb-6"></div>
                @for($i = 0; $i < 8; $i++)
                    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
                        <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded-lg h-16 w-16 flex-shrink-0"></div>
                        <div class="flex-1 space-y-2">
                            <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-4 w-3/4"></div>
                            <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-3 w-1/2"></div>
                        </div>
                        <div class="animate-pulse bg-gray-200 dark:bg-gray-700 rounded h-5 w-16"></div>
                    </div>
                @endfor
            </div>
        @endif
    </div>

    {{-- REAL CONTENT SLOT --}}
    <div x-show="!loading">
        {{ $slot }}
    </div>
</div>