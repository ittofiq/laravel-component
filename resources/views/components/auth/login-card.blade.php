{{-- Komponen Login Card — form login siap pakai --}}
@props([
    'title' => 'Sign In',
    'subtitle' => null,
    'action' => '#',
    'method' => 'POST',
    'brand' => 'B',
    'emailLabel' => 'Email',
    'emailPlaceholder' => 'you@example.com',
    'passwordLabel' => 'Password',
    'passwordPlaceholder' => 'Masukkan password',
    'rememberLabel' => 'Ingat saya',
    'forgotLabel' => 'Lupa password?',
    'forgotUrl' => '#',
    'submitLabel' => 'Masuk',
    'footerText' => 'Belum punya akun?',
    'footerLinkLabel' => 'Daftar',
    'footerLinkUrl' => '#',
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
            <x-form.password-input name="password" :label="$passwordLabel" :placeholder="$passwordPlaceholder" />

            <div class="flex items-center justify-between">
                <x-form.checkbox name="remember" :label="$rememberLabel" />
                <a href="{{ $forgotUrl }}" class="text-xs font-medium text-blue-500 hover:underline">{{ $forgotLabel }}</a>
            </div>

            <x-ui.button type="submit" variant="primary" class="w-full justify-center">{{ $submitLabel }}</x-ui.button>
        </form>
    </div>

    @if($footerText || $footerLinkLabel)
        <p class="text-center text-sm text-gray-500 dark:text-gray-400 mt-4">
            {{ $footerText }}
            <a href="{{ $footerLinkUrl }}" class="text-blue-500 hover:underline font-medium">{{ $footerLinkLabel }}</a>
        </p>
    @endif
</div>