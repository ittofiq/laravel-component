@extends('layouts.app')

@section('title', 'Component Explorer - BacaDev')

@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => null])

    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-4xl font-bold mb-2 text-gray-900 dark:text-white">🧪 Component Explorer</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">Playground interaktif ala Storybook — ubah props, lihat hasilnya langsung, salin kodenya.</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Button --}}
            <x-ui.playground component="ui.button" title="Button" content="Click Me" :controls="[
                ['name' => 'variant', 'label' => 'Variant', 'type' => 'select', 'options' => ['primary', 'secondary', 'danger', 'success'], 'default' => 'primary'],
                ['name' => 'size', 'label' => 'Size', 'type' => 'select', 'options' => ['sm', 'md', 'lg'], 'default' => 'md'],
                ['name' => 'disabled', 'label' => 'Disabled', 'type' => 'checkbox', 'default' => false],
            ]">
                <button
                    type="button"
                    class="font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2"
                    :class="{
                        'bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-400': variant === 'primary',
                        'bg-gray-200 text-gray-900 hover:bg-gray-300 focus:ring-gray-300': variant === 'secondary',
                        'bg-red-500 text-white hover:bg-red-600 focus:ring-red-400': variant === 'danger',
                        'bg-green-500 text-white hover:bg-green-600 focus:ring-green-400': variant === 'success',
                        'px-3 py-1.5 text-sm': size === 'sm',
                        'px-4 py-2 text-base': size === 'md',
                        'px-6 py-3 text-lg': size === 'lg',
                        'opacity-50 cursor-not-allowed': disabled
                    }"
                    :disabled="disabled"
                >Click Me</button>
            </x-ui.playground>

            {{-- Badge --}}
            <x-ui.playground component="ui.badge" title="Badge" content="Badge" :controls="[
                ['name' => 'variant', 'label' => 'Variant', 'type' => 'select', 'options' => ['primary', 'success', 'warning', 'danger'], 'default' => 'primary'],
                ['name' => 'size', 'label' => 'Size', 'type' => 'select', 'options' => ['sm', 'md', 'lg'], 'default' => 'md'],
            ]">
                <span
                    class="inline-flex items-center font-semibold rounded-full"
                    :class="{
                        'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300': variant === 'primary',
                        'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300': variant === 'success',
                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300': variant === 'warning',
                        'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300': variant === 'danger',
                        'px-2 py-0.5 text-xs': size === 'sm',
                        'px-3 py-1 text-sm': size === 'md',
                        'px-4 py-1.5 text-base': size === 'lg',
                    }"
                >Badge</span>
            </x-ui.playground>

            {{-- Avatar --}}
            <x-ui.playground component="ui.avatar" title="Avatar" content="JD" :controls="[
                ['name' => 'initials', 'label' => 'Initials', 'type' => 'text', 'default' => 'JD'],
                ['name' => 'size', 'label' => 'Size', 'type' => 'select', 'options' => ['sm', 'md', 'lg'], 'default' => 'md'],
                ['name' => 'color', 'label' => 'Color', 'type' => 'select', 'options' => ['blue', 'green', 'red', 'purple'], 'default' => 'blue'],
            ]">
                <div
                    class="rounded-full flex items-center justify-center font-bold"
                    :class="{
                        'w-8 h-8 text-xs': size === 'sm',
                        'w-12 h-12 text-base': size === 'md',
                        'w-16 h-16 text-xl': size === 'lg',
                        'bg-blue-500 text-white': color === 'blue',
                        'bg-green-500 text-white': color === 'green',
                        'bg-red-500 text-white': color === 'red',
                        'bg-purple-500 text-white': color === 'purple',
                    }"
                    x-text="initials"
                ></div>
            </x-ui.playground>

            {{-- Toggle --}}
            <x-ui.playground component="form.toggle" title="Toggle" content="Label" :controls="[
                ['name' => 'color', 'label' => 'Color', 'type' => 'select', 'options' => ['blue', 'green', 'red', 'purple'], 'default' => 'blue'],
                ['name' => 'disabled', 'label' => 'Disabled', 'type' => 'checkbox', 'default' => false],
            ]">
                <button
                    type="button"
                    class="relative inline-flex items-center rounded-full transition-colors w-11 h-6 focus:outline-none focus:ring-2 focus:ring-offset-2"
                    :class="{
                        'focus:ring-blue-400': color === 'blue',
                        'focus:ring-green-400': color === 'green',
                        'focus:ring-red-400': color === 'red',
                        'focus:ring-purple-400': color === 'purple',
                        'opacity-50 cursor-not-allowed': disabled
                    }"
                    :disabled="disabled"
                >
                    <span
                        class="inline-block w-5 h-5 bg-white rounded-full shadow transform transition-transform translate-x-5"
                        :class="{ 'translate-x-5': true, 'translate-x-0.5': false }"
                    ></span>
                </button>
            </x-ui.playground>

            {{-- Progress Bar --}}
            <x-ui.playground component="data.progress-bar" title="Progress Bar" content="70%" :controls="[
                ['name' => 'value', 'label' => 'Value', 'type' => 'select', 'options' => ['25', '50', '75', '100'], 'default' => '75'],
                ['name' => 'color', 'label' => 'Color', 'type' => 'select', 'options' => ['blue', 'green', 'red', 'purple'], 'default' => 'blue'],
            ]">
                <div class="w-64 bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
                    <div
                        class="h-full rounded-full transition-all"
                        :class="{
                            'bg-blue-500': color === 'blue',
                            'bg-green-500': color === 'green',
                            'bg-red-500': color === 'red',
                            'bg-purple-500': color === 'purple',
                        }"
                        :style="'width: ' + value + '%'"
                    ></div>
                </div>
            </x-ui.playground>

            {{-- Alert --}}
            <x-ui.playground component="feedback.alert" title="Alert" content="Pesan notifikasi" :controls="[
                ['name' => 'type', 'label' => 'Type', 'type' => 'select', 'options' => ['info', 'success', 'warning', 'error'], 'default' => 'info'],
            ]">
                <div
                    class="px-4 py-3 rounded-lg border flex items-center gap-2 text-sm"
                    :class="{
                        'bg-blue-50 border-blue-200 text-blue-800 dark:bg-blue-900/30 dark:border-blue-800 dark:text-blue-200': type === 'info',
                        'bg-green-50 border-green-200 text-green-800 dark:bg-green-900/30 dark:border-green-800 dark:text-green-200': type === 'success',
                        'bg-yellow-50 border-yellow-200 text-yellow-800 dark:bg-yellow-900/30 dark:border-yellow-800 dark:text-yellow-200': type === 'warning',
                        'bg-red-50 border-red-200 text-red-800 dark:bg-red-900/30 dark:border-red-800 dark:text-red-200': type === 'error',
                    }"
                >
                    <span x-text="type === 'info' ? 'ℹ️' : (type === 'success' ? '✅' : (type === 'warning' ? '⚠️' : '❌'))"></span>
                    <span>Pesan notifikasi</span>
                </div>
            </x-ui.playground>

            {{-- Input --}}
            <x-ui.playground component="form.input" title="Input" content="" :controls="[
                ['name' => 'placeholder', 'label' => 'Placeholder', 'type' => 'text', 'default' => 'Ketik teks...'],
                ['name' => 'disabled', 'label' => 'Disabled', 'type' => 'checkbox', 'default' => false],
            ]">
                <input
                    type="text"
                    :placeholder="placeholder"
                    :disabled="disabled"
                    class="w-full max-w-xs px-3 py-2 rounded-lg border bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                    :class="disabled ? 'border-gray-200 dark:border-gray-600 opacity-60 cursor-not-allowed' : 'border-gray-300 dark:border-gray-600'"
                />
            </x-ui.playground>

            {{-- Spinner --}}
            <x-ui.playground component="feedback.spinner" title="Spinner" content="Loading" :controls="[
                ['name' => 'size', 'label' => 'Size', 'type' => 'select', 'options' => ['sm', 'md', 'lg'], 'default' => 'md'],
                ['name' => 'color', 'label' => 'Color', 'type' => 'select', 'options' => ['blue', 'green', 'red', 'gray'], 'default' => 'blue'],
            ]">
                <div
                    class="rounded-full border-2 border-gray-300 dark:border-gray-600 border-t-transparent animate-spin"
                    :class="{
                        'w-4 h-4': size === 'sm',
                        'w-8 h-8': size === 'md',
                        'w-12 h-12': size === 'lg',
                        'border-t-blue-500': color === 'blue',
                        'border-t-green-500': color === 'green',
                        'border-t-red-500': color === 'red',
                        'border-t-gray-500': color === 'gray',
                    }"
                ></div>
            </x-ui.playground>

        </div>

        {{-- Footer note --}}
        <p class="text-sm text-gray-400 dark:text-gray-500 mt-8">
            💡 Explorer ini mencontohkan pola <code class="font-mono">x-ui.playground</code> — komponen reusable untuk demo interaktif.
            Lihat file <code class="font-mono">resources/views/components/ui/playground.blade.php</code> untuk menambah playground baru.
        </p>
    </div>
</div>
@endsection