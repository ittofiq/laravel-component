{{-- Komponen Reset Password Card — form reset password siap pakai --}}
@props([
    'title' => 'Reset Password',
    'subtitle' => 'Masukkan email untuk menerima link reset.',
    'action' => '#',
    'method' => 'POST',
    'brand' => 'B',
    'emailLabel' => 'Email',
    'emailPlaceholder' => 'you@example.com',
    'submitLabel' => 'Kirim Link Reset',
    'backLabel' => 'Kembali ke login',
    'backUrl' => '#',
])

<div class="w-full max-w-sm mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-lg p-6 lg:p-8">
        {{-- Header --}}
        <div class="text-center mb-6">
            <div class="w-12 h-12 mx-auto rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-xl font-bold mb-3">{{ $brand }}</div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $title }}</h2>
            @if($subtitle)
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $subtitle }}</p>
            @endif
        </div>

        <form action="{{ $action }}" method="{{ $method }}" class="space-y-4">
            @csrf
            <x-form.input name="email" type="email" :label="$emailLabel" :placeholder="$emailPlaceholder" :required="true" />
            <x-ui.button type="submit" variant="primary" class="w-full justify-center">{{ $submitLabel }}</x-ui.button>
        </form>
    </div>

    @if($backLabel)
        <p class="text-center text-sm text-gray-500 dark:text-gray-400 mt-4">
            <a href="{{ $backUrl }}" class="text-blue-500 hover:underline font-medium">{{ $backLabel }}</a>
        </p>
    @endif
</div>