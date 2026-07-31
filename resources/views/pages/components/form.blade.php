@extends('layouts.app')
@section('title', 'Form Components - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'form'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">📝 Form Components</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">27 komponen: Input, Password Input, OTP Input, Chip Input, Range Slider, Input Group, Floating Label, Textarea, Select, Checkbox, Radio, Toggle, Date Input, Time Input, DateTime Input, Date Picker, Auto-Complete, Multi-Select, Image Uploader, Color Picker, File Upload, Styled File Input, Search Input, Combobox, Form Wizard, Rating Input, Rich Text Editor</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Currency Input</h3>
                <div class="space-y-3">
                    <x-form.currency-input name="price" label="Harga (IDR)" currency="IDR" />
                    <x-form.currency-input name="amount" label="Amount (USD)" currency="USD" />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Phone Input</h3>
                <x-form.phone-input name="phone" label="Phone Number" placeholder="81234567890" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Input</h3>
                <div class="space-y-3">
                    <x-form.input name="basic" placeholder="Basic input" />
                    <x-form.input name="labeled" label="Email" type="email" placeholder="test@example.com" />
                    <x-form.input name="required" label="Username" required placeholder="Enter username" />
                    <x-form.input name="disabled" label="Disabled" disabled placeholder="This is disabled" />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">OTP Input</h3>
                <div class="space-y-3">
                    <x-form.otp-input name="code" label="Verification Code" />
                    <x-form.otp-input name="code_err" label="With Error" error="Invalid code. Please try again." />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Password Input</h3>
                <div class="space-y-3">
                    <x-form.password-input name="password" label="Password" />
                    <x-form.password-input name="confirm" label="Confirm Password" placeholder="Konfirmasi password" />
                    <x-form.password-input name="err" label="Error State" error="Password minimal 8 karakter" />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Input Group</h3>
                <div class="space-y-3">
                    <x-form.input-group name="url" label="URL" prefix="https://" placeholder="example.com" />
                    <x-form.input-group name="username" label="Username" prefixIcon="@" placeholder="johndoe" />
                    <x-form.input-group name="price" label="Price" prefix="$" suffix=".00" placeholder="0" />
                    <x-form.input-group name="email" label="Email" suffixIcon="📧" placeholder="your@email.com" />
                    <x-form.input-group name="search" prefixIcon="🔍" placeholder="Search..." />
                </div>
            </div>

            {{-- Form Layout: Login Card --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Form Layout — Login</h3>
                <div class="max-w-sm mx-auto">
                    <h4 class="text-lg font-bold text-gray-900 dark:text-white text-center mb-4">Welcome Back</h4>
                    <form class="space-y-3">
                        <x-form.input-group name="email2" prefixIcon="📧" placeholder="Email address" />
                        <x-form.input-group name="pass" prefixIcon="🔒" placeholder="Password" />
                        <div class="flex items-center justify-between">
                            <x-form.checkbox name="remember" label="Remember me" />
                            <a href="#" class="text-xs text-blue-500 hover:underline">Forgot?</a>
                        </div>
                        <x-ui.button variant="primary" class="w-full justify-center">Sign In</x-ui.button>
                    </form>
                </div>
            </div>

            {{-- Form Layout: Inline --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Form Layout — Inline</h3>
                <form class="flex items-end gap-3">
                    <div class="flex-1 min-w-[140px]"><x-form.input name="city" placeholder="City" /></div>
                    <div class="flex-1 min-w-[140px]"><x-form.input name="type" placeholder="Type" /></div>
                    <div class="flex-1 min-w-[140px]"><x-form.input name="max" placeholder="Max price" /></div>
                    <div class="flex-1 min-w-[140px]"><x-ui.button variant="primary">Search</x-ui.button></div>
                </form>
            </div>

            {{-- Form Layout: Horizontal --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow lg:col-span-2"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Form Layout — Horizontal</h3>
                <form class="space-y-4 max-w-2xl">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                        <label class="sm:w-32 text-sm font-medium text-gray-700 dark:text-gray-300 flex-shrink-0">Full Name</label>
                        <div class="flex-1"><x-form.input name="first" placeholder="First" /></div>
                        <div class="flex-1"><x-form.input name="last" placeholder="Last" /></div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                        <label class="sm:w-32 text-sm font-medium text-gray-700 dark:text-gray-300 flex-shrink-0">Email</label>
                        <div class="flex-1"><x-form.input name="email3" type="email" placeholder="you@example.com" /></div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                        <label class="sm:w-32 text-sm font-medium text-gray-700 dark:text-gray-300 flex-shrink-0">Role</label>
                        <div class="flex-1"><x-form.select name="role2" :options="['' => 'Select role', 'admin' => 'Admin', 'editor' => 'Editor', 'viewer' => 'Viewer']" /></div>
                    </div>
                    <div class="flex sm:pl-36 gap-2">
                        <x-ui.button variant="primary" size="sm">Save</x-ui.button>
                        <x-ui.button variant="secondary" size="sm">Cancel</x-ui.button>
                    </div>
                </form>
            </div>

            {{-- Form Layout: Card with sections --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow lg:col-span-2"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Form Layout — Sections</h3>
                <div class="max-w-2xl space-y-6">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white pb-2 border-b border-gray-200 dark:border-gray-700">Personal Info</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-3">
                            <x-form.input name="first2" label="First Name" />
                            <x-form.input name="last2" label="Last Name" />
                            <x-form.input name="email4" label="Email" type="email" />
                            <x-form.input name="phone2" label="Phone" />
                        </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white pb-2 border-b border-gray-200 dark:border-gray-700">Address</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-3">
                            <x-form.input name="street" label="Street" />
                            <x-form.input name="city2" label="City" />
                            <x-form.input name="zip" label="ZIP" />
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <x-ui.button variant="primary">Submit</x-ui.button>
                        <x-ui.button variant="secondary">Reset</x-ui.button>
                    </div>
                </div>
            </div>

            {{-- Form Layout: Register --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Form Layout — Register</h3>
                <div class="max-w-sm mx-auto">
                    <h4 class="text-lg font-bold text-gray-900 dark:text-white text-center mb-1">Create Account</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center mb-4">Fill in the form to get started</p>
                    <form class="space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            <x-form.input name="first3" placeholder="First name" />
                            <x-form.input name="last3" placeholder="Last name" />
                        </div>
                        <x-form.input name="email5" type="email" placeholder="Email address" />
                        <x-form.password-input name="pass2" placeholder="Password" />
                        <x-form.password-input name="confirm2" placeholder="Confirm password" />
                        <x-form.checkbox name="terms" label="I agree to the Terms of Service" />
                        <x-ui.button variant="primary" class="w-full justify-center">Create Account</x-ui.button>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Already have an account? <a href="#" class="text-blue-500 hover:underline">Sign in</a></p>
                    </form>
                </div>
            </div>

            {{-- Form Layout: Reset Password --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Form Layout — Reset Password</h3>
                <div class="max-w-sm mx-auto">
                    <h4 class="text-lg font-bold text-gray-900 dark:text-white text-center mb-1">Reset Password</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center mb-4">Enter your email to receive a reset link</p>
                    <form class="space-y-3">
                        <x-form.input-group name="email6" prefixIcon="📧" placeholder="Email address" />
                        <x-ui.button variant="primary" class="w-full justify-center">Send Reset Link</x-ui.button>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">
                            <a href="#" class="text-blue-500 hover:underline">← Back to login</a>
                        </p>
                    </form>
                </div>
            </div>

            {{-- Form Layout: Profile --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow lg:col-span-2"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Form Layout — Profile Edit</h3>
                <div class="max-w-2xl">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 rounded-full bg-blue-500 flex items-center justify-center text-white text-2xl font-bold">JD</div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white">John Doe</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">john@example.com</p>
                            <a href="#" class="text-xs text-blue-500 hover:underline">Change photo</a>
                        </div>
                    </div>
                    <form class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-form.input name="first4" label="First Name" value="John" />
                            <x-form.input name="last4" label="Last Name" value="Doe" />
                            <x-form.input name="email7" label="Email" type="email" value="john@example.com" />
                            <x-form.input name="phone3" label="Phone" value="+62 812-3456-7890" />
                        </div>
                        <x-form.textarea name="bio" label="Bio" rows="2" placeholder="Tell us about yourself..." />
                        <div class="flex gap-2">
                            <x-ui.button variant="primary">Save Changes</x-ui.button>
                            <x-ui.button variant="secondary">Cancel</x-ui.button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Form Layout: Checkout --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow lg:col-span-2"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Form Layout — Checkout</h3>
                <div class="max-w-2xl">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Shipping</h4>
                            <x-form.input name="fullname" label="Full Name" />
                            <x-form.input name="address" label="Address" />
                            <div class="grid grid-cols-2 gap-3">
                                <x-form.input name="city3" label="City" />
                                <x-form.input name="zip2" label="ZIP" />
                            </div>
                            <x-form.select name="country" label="Country" :options="['' => 'Select', 'id' => 'Indonesia', 'us' => 'USA', 'sg' => 'Singapore']" />
                        </div>
                        <div class="space-y-4">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Payment</h4>
                            <x-form.input name="card" label="Card Number" placeholder="1234 5678 9012 3456" />
                            <div class="grid grid-cols-2 gap-3">
                                <x-form.input name="expiry" label="Expiry" placeholder="MM/YY" />
                                <x-form.input name="cvv" label="CVV" placeholder="123" />
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 space-y-1.5 text-sm">
                                <div class="flex justify-between"><span class="text-gray-500 dark:text-gray-400">Subtotal</span><span class="text-gray-700 dark:text-gray-300">$99.00</span></div>
                                <div class="flex justify-between"><span class="text-gray-500 dark:text-gray-400">Shipping</span><span class="text-gray-700 dark:text-gray-300">$5.00</span></div>
                                <div class="flex justify-between font-bold border-t border-gray-200 dark:border-gray-600 pt-1.5"><span class="text-gray-900 dark:text-white">Total</span><span class="text-gray-900 dark:text-white">$104.00</span></div>
                            </div>
                            <x-ui.button variant="primary" class="w-full justify-center">Place Order</x-ui.button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Floating Label</h3>
                <div class="space-y-4">
                    <x-form.floating-label name="email" label="Email Address" type="email" />
                    <x-form.floating-label name="password" label="Password" type="password" />
                    <x-form.floating-label name="username" label="Username" :required="true" />
                    <x-form.floating-label name="disabled" label="Disabled" disabled />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Textarea</h3>
                <x-form.textarea name="basic" placeholder="Basic textarea" />
                <x-form.textarea name="labeled" label="Message" placeholder="Your message..." class="mt-3" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Select</h3>
                <x-form.select name="option" label="Choose" :options="['a' => 'Option A', 'b' => 'Option B', 'c' => 'Option C']" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Checkbox & Radio</h3>
                <x-form.checkbox name="agree" label="I agree to terms" />
                <x-form.radio name="choice" value="yes" label="Yes" class="mt-3" />
                <x-form.radio name="choice" value="no" label="No" class="mt-1" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Range Slider</h3>
                <div class="space-y-4">
                    <x-form.range-slider name="volume" label="Volume" :value="65" :showMinMax="true" />
                    <x-form.range-slider name="price" label="Price Range" :values="[25, 75]" :min="0" :max="100" :showMinMax="true" />
                    <x-form.range-slider name="budget" label="Budget" :values="[300, 700]" :min="0" :max="1000" :showMinMax="true" />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Rating Input</h3>
                <div class="space-y-3">
                    <x-form.rating-input name="rating" label="Product Rating" :value="3" />
                    <x-form.rating-input name="satisfaction" label="Satisfaction" :value="4" color="green" />
                    <x-form.rating-input name="readonly" label="Read Only" :value="5" disabled />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Toggle / Switch</h3>
                <div class="space-y-3">
                    <x-form.toggle name="notifications" label="Enable Notifications" :checked="true" />
                    <x-form.toggle name="dark_mode" label="Dark Mode" color="green" />
                    <x-form.toggle name="updates" label="Auto Updates" color="purple" :checked="true" />
                    <x-form.toggle name="disabled_toggle" label="Disabled" disabled />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Date & Time</h3>
                <x-form.date-input name="date" label="Date" />
                <x-form.time-input name="time" label="Time" class="mt-3" />
                <x-form.datetime-input name="datetime" label="DateTime" class="mt-3" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Date Picker</h3>
                <x-form.date-picker name="birthdate" label="Tanggal Lahir" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Auto-Complete</h3>
                <x-form.auto-complete name="language" :options="['JavaScript', 'Python', 'PHP', 'Java', 'Go', 'Rust', 'TypeScript']" label="Language" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Chip Input</h3>
                <div class="space-y-3">
                    <x-form.chip-input name="emails" label="Email Recipients" placeholder="Type email then Enter..." :chips="['john@example.com', 'jane@example.com']" />
                    <x-form.chip-input name="tags" label="Tags" placeholder="Add tag..." :maxChips="5" />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Multi-Select</h3>
                <x-form.multi-select name="skills" label="Skills" :options="['js' => 'JavaScript', 'php' => 'PHP', 'python' => 'Python']" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Color Picker</h3>
                <x-form.color-picker name="color" label="Pick Color" value="#3B82F6" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Styled File Input</h3>
                <x-form.styled-file-input name="photos" label="Upload Photos" :multiple="true" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">File Upload</h3>
                <x-form.file-upload name="file" label="Upload File" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Search Input</h3>
                <x-form.search-input name="search" label="Search" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Combobox</h3>
                <x-form.combobox name="category" label="Category" :options="['Design', 'Development', 'Marketing', 'Sales']" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Form Wizard</h3>
                <x-form.form-wizard :steps="['Account', 'Profile', 'Confirmation']" :currentStep="2" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Button Link Variants</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Link-styled buttons for navigation, actions, and inline text</p>
                <div class="space-y-3">
                    <div class="flex flex-wrap gap-2 items-center">
                        <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:underline transition">Simple Link →</a>
                        <span class="text-gray-300 dark:text-gray-600">|</span>
                        <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:underline transition">Forgot password?</a>
                        <span class="text-gray-300 dark:text-gray-600">|</span>
                        <a href="#" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:underline transition">Terms of Service</a>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a href="#" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg> Back
                        </a>
                        <a href="#" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg> Download
                        </a>
                        <a href="#" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg> Delete
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a href="#" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-blue-500 text-white rounded-full hover:bg-blue-600 transition">Pill Link</a>
                        <a href="#" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300 rounded-full hover:bg-green-200 dark:hover:bg-green-900/50 transition">Approved</a>
                        <a href="#" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition">#tag</a>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a href="#" class="group inline-flex items-center gap-1 text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline transition">
                            Learn more
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="#" class="group inline-flex items-center gap-1 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                            View all
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Rich Text Editor</h3>
                <x-form.rich-text-editor name="content" label="Content" />
            </div>
        </div>
    </div>
</div>
@endsection
