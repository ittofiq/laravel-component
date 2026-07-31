{{-- Komponen 2FA Authentication dengan Tailwind CSS --}}
@props([
    'step' => 1, // 1: Phone input, 2: Code verification, 3: Success
])

<div class="w-full max-w-md mx-auto space-y-6">
    @if($step === 1)
        <!-- Step 1: Phone Input -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Verify Your Phone</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-2">We'll send a code to your phone number</p>
        </div>

        <div class="space-y-4">
            <input type="tel" placeholder="Enter phone number" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <button class="w-full px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 font-bold transition">Send Code</button>
        </div>

    @elseif($step === 2)
        <!-- Step 2: Code Verification -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Enter Code</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Check your phone for the 6-digit code</p>
        </div>

        <div class="space-y-4">
            <div class="flex gap-2 justify-center">
                @for($i = 0; $i < 6; $i++)
                    <input type="text" maxlength="1" class="w-12 h-12 text-center border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-2xl focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @endfor
            </div>
            <button class="w-full px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 font-bold transition">Verify</button>
            <p class="text-sm text-gray-600 dark:text-gray-400 text-center">Didn't receive? <button class="text-blue-500 hover:text-blue-600">Resend</button></p>
        </div>

    @elseif($step === 3)
        <!-- Step 3: Success -->
        <div class="text-center">
            <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Verification Complete</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Your account is now secured with 2FA</p>
            <button class="w-full mt-6 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 font-bold transition">Continue</button>
        </div>
    @endif
</div>
