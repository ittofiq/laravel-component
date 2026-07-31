@extends('layouts.app')
@section('title', 'Layout - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'layout'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">🏗️ Layout</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">11 komponen: Hero, Section, Container, Grid, Footer, FAQ, Image Gallery, Accordion, Carousel, Masonry Grid, Waterfall Layout</p>
        <div class="grid grid-cols-1 gap-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Hero</h3>
                <x-layout.hero title="Welcome to BacaDev" subtitle="100+ component library built with Tailwind CSS" />
                <div class="mt-4 p-6 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl text-white text-center">
                    <h2 class="text-2xl font-bold">Build Faster with Components</h2>
                    <p class="text-sm mt-2 opacity-90">Production-ready, dark mode, responsive, zero dependencies</p>
                    <div class="flex justify-center gap-3 mt-4">
                        <a href="#" class="px-4 py-2 text-sm font-medium bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition">Get Started</a>
                        <a href="#" class="px-4 py-2 text-sm font-medium border border-white/30 text-white rounded-lg hover:bg-white/10 transition">View Docs</a>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Section</h3>
                <x-layout.section title="Section Title" subtitle="With a subtitle"><p class="text-gray-600 dark:text-gray-400">Section content</p></x-layout.section>
                <div class="mt-4 bg-gray-50 dark:bg-gray-700/30 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Dark Background Section</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Section with subtle background color and compact layout.</p>
                    <div class="flex gap-2 mt-3">
                        <button class="px-3 py-1.5 text-xs font-medium bg-blue-500 text-white rounded-lg">Action</button>
                        <button class="px-3 py-1.5 text-xs font-medium bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg">Secondary</button>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Container</h3>
                    <div class="max-w-sm mx-auto p-4 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-center text-sm text-gray-600 dark:text-gray-400">Container max-width</div>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Grid</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">3 Columns</p>
                    <x-layout.grid :cols="3" :gap="4">
                        <div class="p-4 bg-blue-50 dark:bg-blue-900/30 rounded text-center text-sm">Col 1</div>
                        <div class="p-4 bg-green-50 dark:bg-green-900/30 rounded text-center text-sm">Col 2</div>
                        <div class="p-4 bg-purple-50 dark:bg-purple-900/30 rounded text-center text-sm">Col 3</div>
                    </x-layout.grid>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 mt-4">4 Columns</p>
                    <x-layout.grid :cols="4" :gap="3">
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded text-center text-xs">1</div>
                        <div class="p-3 bg-green-50 dark:bg-green-900/30 rounded text-center text-xs">2</div>
                        <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded text-center text-xs">3</div>
                        <div class="p-3 bg-orange-50 dark:bg-orange-900/30 rounded text-center text-xs">4</div>
                    </x-layout.grid>
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">FAQ</h3>
                <x-layout.faq :faqs="[
                    ['question' => 'Apa itu BacaDev?', 'answer' => 'BacaDev adalah component library Tailwind CSS untuk Laravel dengan 77+ komponen siap pakai.'],
                    ['question' => 'Apakah gratis?', 'answer' => 'Ya, BacaDev sepenuhnya open-source dan gratis digunakan untuk project pribadi maupun komersial.'],
                    ['question' => 'Apakah support dark mode?', 'answer' => 'Ya! Semua komponen sudah mendukung dark mode dengan Tailwind CSS dark: prefix.'],
                ]" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Accordion</h3>
                <x-layout.accordion :items="[
                    ['title' => 'What is BacaDev?', 'content' => 'A comprehensive Tailwind CSS component library for Laravel with 100+ ready-to-use components.'],
                    ['title' => 'Is it free?', 'content' => 'Yes! Completely open-source and free for personal and commercial projects.'],
                    ['title' => 'Dark mode support?', 'content' => 'All components fully support dark mode with Tailwind CSS dark: prefix.'],
                ]" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Carousel</h3>
                <x-layout.carousel :items="[
                    'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'800\' height=\'400\'><rect fill=\'#dbeafe\' width=\'800\' height=\'400\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'#1d4ed8\' font-size=\'24\'>Slide 1</text></svg>'),
                    'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'800\' height=\'400\'><rect fill=\'#d1fae5\' width=\'800\' height=\'400\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'#065f46\' font-size=\'24\'>Slide 2</text></svg>'),
                    'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'800\' height=\'400\'><rect fill=\'#fef3c7\' width=\'800\' height=\'400\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'#92400e\' font-size=\'24\'>Slide 3</text></svg>'),
                ]" :autoplay="true" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Image Gallery</h3>
                    <x-layout.image-gallery :images="[str_replace('300','200',str_replace('e5e7eb','dbeafe',str_replace('9ca3af','1d4ed8','data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'300\' height=\'200\'><rect fill=\'#e5e7eb\' width=\'300\' height=\'200\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'#9ca3af\' font-size=\'14\'>Img</text></svg>'))))]" :columns="3" />
                </div>
                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Masonry Grid</h3>
                    <x-layout.masonry-grid :items="[
                    ['title' => 'Getting Started', 'description' => 'Quick setup guide for new users.'],
                    ['title' => 'Components', 'description' => 'Explore all 100+ components.'],
                    ['title' => 'Dark Mode', 'description' => 'Full dark mode support.'],
                    ['title' => 'API Reference', 'description' => 'Detailed props documentation.'],
                ]" />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Footer</h3>
                <x-layout.footer brand="BacaDev" description="Component Library Tailwind CSS untuk Laravel. 76+ komponen siap pakai." :links="[
                    ['title' => 'Components', 'items' => [
                        ['label' => 'UI', 'href' => '/components/ui'],
                        ['label' => 'Form', 'href' => '/components/form'],
                        ['label' => 'Data', 'href' => '/components/data'],
                    ]],
                    ['title' => 'Resources', 'items' => [
                        ['label' => 'Documentation', 'href' => '#'],
                        ['label' => 'GitHub', 'href' => '#'],
                        ['label' => 'Changelog', 'href' => '#'],
                    ]],
                ]" :socialLinks="[
                    ['label' => 'GitHub', 'icon' => '🐙', 'href' => '#'],
                    ['label' => 'Twitter', 'icon' => '🐦', 'href' => '#'],
                ]" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Waterfall Layout</h3>
                {{-- Blog Home Layout --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow lg:col-span-2"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Blog Home Layout</h3>
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                    {{-- Blog Navbar --}}
                    <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-3 flex items-center justify-between">
                        <span class="text-lg font-bold text-gray-900 dark:text-white">📝 BlogDev</span>
                        <div class="hidden sm:flex items-center gap-4 text-sm">
                            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">Home</a>
                            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">Articles</a>
                            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">Categories</a>
                            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">About</a>
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="px-3 py-1.5 text-sm bg-blue-500 text-white rounded-lg">Subscribe</button>
                        </div>
                    </div>

                    {{-- Hero Article --}}
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-8">
                        <span class="inline-block px-2.5 py-0.5 text-xs font-medium bg-white/20 rounded-full mb-3">Featured</span>
                        <h2 class="text-2xl font-bold">Building Modern Web Apps with Laravel & Tailwind</h2>
                        <p class="text-sm mt-2 opacity-90 max-w-lg">Discover how to leverage the power of Laravel and Tailwind CSS to build stunning, performant web applications.</p>
                        <div class="flex items-center gap-3 mt-4 text-sm opacity-80">
                            <span>📅 Jan 15, 2024</span>
                            <span>⏱️ 8 min read</span>
                        </div>
                    </div>

                    {{-- Featured Grid --}}
                    <div class="p-6">
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">📌 Featured Articles</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-md transition">
                                <div class="h-32 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-3xl">📝</div>
                                <div class="p-4">
                                    <span class="text-xs text-blue-500 font-medium">Technology</span>
                                    <h5 class="text-sm font-bold text-gray-900 dark:text-white mt-1">Getting Started Guide</h5>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Jan 10 • 5 min</p>
                                </div>
                            </div>
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-md transition">
                                <div class="h-32 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white text-3xl">🎨</div>
                                <div class="p-4">
                                    <span class="text-xs text-green-500 font-medium">Design</span>
                                    <h5 class="text-sm font-bold text-gray-900 dark:text-white mt-1">UI Component Patterns</h5>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Jan 12 • 6 min</p>
                                </div>
                            </div>
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-md transition">
                                <div class="h-32 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white text-3xl">🚀</div>
                                <div class="p-4">
                                    <span class="text-xs text-purple-500 font-medium">Performance</span>
                                    <h5 class="text-sm font-bold text-gray-900 dark:text-white mt-1">Optimization Tips</h5>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Jan 18 • 4 min</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Content + Sidebar --}}
                    <div class="border-t border-gray-200 dark:border-gray-700 p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            {{-- Main Content --}}
                            <div class="lg:col-span-2 space-y-4">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white">📰 Latest Articles</h4>
                                @for($i = 1; $i <= 3; $i++)
                                    <div class="flex gap-4 p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:shadow-sm transition">
                                        <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-blue-100 to-blue-300 dark:from-blue-900/30 dark:to-blue-800/30 flex-shrink-0"></div>
                                        <div class="flex-1 min-w-0">
                                            <span class="text-xs text-blue-500 dark:text-blue-400 font-medium">Category</span>
                                            <h5 class="text-sm font-bold text-gray-900 dark:text-white mt-0.5">Article Title {{ $i }}</h5>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-1">Brief description of the article content goes here...</p>
                                            <span class="text-xs text-gray-400 mt-1">Jan {{ 10 + $i }} • {{ 3 + $i }} min read</span>
                                        </div>
                                    </div>
                                @endfor
                                <button class="w-full py-2 text-sm text-blue-500 hover:text-blue-600 font-medium">Load More Articles →</button>
                            </div>

                            {{-- Sidebar --}}
                            <div class="space-y-4">
                                <div class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-4">
                                    <h5 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">📂 Categories</h5>
                                    <div class="space-y-1.5">
                                        <a href="#" class="flex justify-between text-sm text-gray-600 dark:text-gray-400 hover:text-blue-500"><span>Technology</span><span class="text-gray-400">12</span></a>
                                        <a href="#" class="flex justify-between text-sm text-gray-600 dark:text-gray-400 hover:text-blue-500"><span>Design</span><span class="text-gray-400">8</span></a>
                                        <a href="#" class="flex justify-between text-sm text-gray-600 dark:text-gray-400 hover:text-blue-500"><span>Performance</span><span class="text-gray-400">5</span></a>
                                        <a href="#" class="flex justify-between text-sm text-gray-600 dark:text-gray-400 hover:text-blue-500"><span>Tutorial</span><span class="text-gray-400">15</span></a>
                                    </div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-4">
                                    <h5 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">🏷️ Popular Tags</h5>
                                    <div class="flex flex-wrap gap-1.5">
                                        <span class="px-2 py-0.5 text-xs bg-white dark:bg-gray-700 rounded-full">Laravel</span>
                                        <span class="px-2 py-0.5 text-xs bg-white dark:bg-gray-700 rounded-full">Tailwind</span>
                                        <span class="px-2 py-0.5 text-xs bg-white dark:bg-gray-700 rounded-full">Vue</span>
                                        <span class="px-2 py-0.5 text-xs bg-white dark:bg-gray-700 rounded-full">API</span>
                                        <span class="px-2 py-0.5 text-xs bg-white dark:bg-gray-700 rounded-full">CSS</span>
                                        <span class="px-2 py-0.5 text-xs bg-white dark:bg-gray-700 rounded-full">PHP</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pricing Table Layout --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Pricing Table Layout</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 text-center">
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Starter</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">$9<span class="text-sm font-normal text-gray-500">/mo</span></p>
                        <ul class="mt-4 space-y-2 text-sm text-gray-500 dark:text-gray-400">
                            <li>✅ 5 Projects</li>
                            <li>✅ 10GB Storage</li>
                            <li>✅ Basic Support</li>
                            <li>❌ API Access</li>
                        </ul>
                        <button class="mt-5 w-full py-2 text-sm font-medium border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">Get Started</button>
                    </div>
                    <div class="border-2 border-blue-500 dark:border-blue-400 rounded-xl p-6 text-center relative">
                        <span class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-0.5 text-xs font-bold bg-blue-500 text-white rounded-full">Popular</span>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Pro</p>
                        <p class="text-3xl font-bold text-blue-500 mt-2">$29<span class="text-sm font-normal text-gray-500">/mo</span></p>
                        <ul class="mt-4 space-y-2 text-sm text-gray-500 dark:text-gray-400">
                            <li>✅ 20 Projects</li>
                            <li>✅ 100GB Storage</li>
                            <li>✅ Priority Support</li>
                            <li>✅ API Access</li>
                        </ul>
                        <button class="mt-5 w-full py-2 text-sm font-medium bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Get Started</button>
                    </div>
                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 text-center">
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Enterprise</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">$99<span class="text-sm font-normal text-gray-500">/mo</span></p>
                        <ul class="mt-4 space-y-2 text-sm text-gray-500 dark:text-gray-400">
                            <li>✅ Unlimited Projects</li>
                            <li>✅ 1TB Storage</li>
                            <li>✅ 24/7 Support</li>
                            <li>✅ API Access</li>
                        </ul>
                        <button class="mt-5 w-full py-2 text-sm font-medium border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">Contact Sales</button>
                    </div>
                </div>
            </div>

            {{-- Team Section Layout --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Team Section Layout</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-xl font-bold">JD</div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-2">John Doe</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">CEO & Founder</p>
                        <div class="flex justify-center gap-2 mt-2">
                            <span class="text-sm">🐙</span><span class="text-sm">🐦</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white text-xl font-bold">JS</div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-2">Jane Smith</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Lead Designer</p>
                        <div class="flex justify-center gap-2 mt-2">
                            <span class="text-sm">🎨</span><span class="text-sm">💼</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white text-xl font-bold">BJ</div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-2">Bob Johnson</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Senior Dev</p>
                        <div class="flex justify-center gap-2 mt-2">
                            <span class="text-sm">🐙</span><span class="text-sm">🐦</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white text-xl font-bold">AB</div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-2">Alice Brown</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Product Manager</p>
                        <div class="flex justify-center gap-2 mt-2">
                            <span class="text-sm">💼</span><span class="text-sm">🌐</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contact Form Layout --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow lg:col-span-2"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Contact Form Layout</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <form class="space-y-4">
                        <div class="grid grid-cols-2 gap-3">
                            <x-form.input name="first5" placeholder="First Name" />
                            <x-form.input name="last5" placeholder="Last Name" />
                        </div>
                        <x-form.input name="email8" type="email" placeholder="Email Address" />
                        <x-form.input name="subject" placeholder="Subject" />
                        <x-form.textarea name="message" rows="4" placeholder="Your message..." />
                        <x-ui.button variant="primary" class="w-full justify-center">Send Message</x-ui.button>
                    </form>
                    <div class="space-y-4 text-sm">
                        <div class="flex gap-3">
                            <span class="text-xl">📍</span>
                            <div><p class="font-medium text-gray-900 dark:text-white">Address</p><p class="text-gray-500 dark:text-gray-400">Jl. Sudirman No. 123, Jakarta</p></div>
                        </div>
                        <div class="flex gap-3">
                            <span class="text-xl">📧</span>
                            <div><p class="font-medium text-gray-900 dark:text-white">Email</p><p class="text-gray-500 dark:text-gray-400">hello@bacadev.test</p></div>
                        </div>
                        <div class="flex gap-3">
                            <span class="text-xl">📞</span>
                            <div><p class="font-medium text-gray-900 dark:text-white">Phone</p><p class="text-gray-500 dark:text-gray-400">+62 812-3456-7890</p></div>
                        </div>
                        <div class="flex gap-3">
                            <span class="text-xl">🕐</span>
                            <div><p class="font-medium text-gray-900 dark:text-white">Hours</p><p class="text-gray-500 dark:text-gray-400">Mon–Fri, 9:00–17:00</p></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Dashboard Layout --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow lg:col-span-2"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Dashboard Layout</h3>
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 p-4 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total Revenue</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-white">$12,430</p>
                            <p class="text-xs text-green-500 mt-0.5">↑ 12.5%</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Users</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-white">2,450</p>
                            <p class="text-xs text-green-500 mt-0.5">↑ 8.2%</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Orders</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-white">842</p>
                            <p class="text-xs text-red-500 mt-0.5">↓ 3.1%</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Conversion</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-white">3.24%</p>
                            <p class="text-xs text-green-500 mt-0.5">↑ 0.8%</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 p-4">
                        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white mb-3">📈 Revenue Overview</p>
                            <div class="h-40 bg-gradient-to-b from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/10 rounded flex items-end p-4 gap-2">
                                <div class="flex-1 bg-blue-400 dark:bg-blue-500 rounded-t h-[60%]"></div>
                                <div class="flex-1 bg-blue-400 dark:bg-blue-500 rounded-t h-[80%]"></div>
                                <div class="flex-1 bg-blue-400 dark:bg-blue-500 rounded-t h-[45%]"></div>
                                <div class="flex-1 bg-blue-400 dark:bg-blue-500 rounded-t h-[90%]"></div>
                                <div class="flex-1 bg-blue-400 dark:bg-blue-500 rounded-t h-[70%]"></div>
                                <div class="flex-1 bg-blue-400 dark:bg-blue-500 rounded-t h-[95%]"></div>
                                <div class="flex-1 bg-blue-400 dark:bg-blue-500 rounded-t h-[85%]"></div>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white mb-3">📋 Recent Activity</p>
                            <div class="space-y-3">
                                <div class="flex gap-2 text-xs"><span class="text-blue-500">●</span><span class="text-gray-500 dark:text-gray-400">New user registered</span><span class="text-gray-400 ml-auto">2m ago</span></div>
                                <div class="flex gap-2 text-xs"><span class="text-green-500">●</span><span class="text-gray-500 dark:text-gray-400">Order #123 completed</span><span class="text-gray-400 ml-auto">15m ago</span></div>
                                <div class="flex gap-2 text-xs"><span class="text-yellow-500">●</span><span class="text-gray-500 dark:text-gray-400">Payment pending</span><span class="text-gray-400 ml-auto">1h ago</span></div>
                                <div class="flex gap-2 text-xs"><span class="text-purple-500">●</span><span class="text-gray-500 dark:text-gray-400">Report generated</span><span class="text-gray-400 ml-auto">3h ago</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-layout.waterfall-layout :items="[
                    ['image' => 'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'><rect fill=\'#3B82F6\' width=\'400\' height=\'300\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\' font-size=\'20\'>Getting Started</text></svg>'), 'title' => 'Getting Started', 'description' => 'Quick setup guide for new users.'],
                    ['image' => 'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'200\'><rect fill=\'#10B981\' width=\'400\' height=\'200\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\' font-size=\'20\'>Components</text></svg>'), 'title' => 'Components', 'description' => 'Explore all 100+ ready-to-use components.'],
                    ['image' => 'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'250\'><rect fill=\'#8B5CF6\' width=\'400\' height=\'250\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\' font-size=\'20\'>Dark Mode</text></svg>'), 'title' => 'Dark Mode', 'description' => 'Full dark mode support across all components.'],
                    ['image' => 'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'220\'><rect fill=\'#F59E0B\' width=\'400\' height=\'220\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\' font-size=\'20\'>API</text></svg>'), 'title' => 'API Reference', 'description' => 'Detailed props documentation for every component.'],
                ]" />
            </div>

            {{-- Article List Layout --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Article List Layout</h3>
                <div class="max-w-2xl space-y-4">
                    <div class="flex gap-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:shadow-md transition">
                        <div class="w-24 h-24 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex-shrink-0 flex items-center justify-center text-white text-2xl">📝</div>
                        <div class="flex-1 min-w-0">
                            <span class="text-xs text-blue-500 dark:text-blue-400 font-medium">Technology</span>
                            <h4 class="font-bold text-gray-900 dark:text-white mt-0.5">Getting Started with Tailwind CSS</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">Learn how to set up and use Tailwind CSS in your Laravel project with this step-by-step guide.</p>
                            <div class="flex items-center gap-3 mt-2 text-xs text-gray-400 dark:text-gray-500">
                                <span>📅 Jan 15, 2024</span>
                                <span>⏱️ 5 min read</span>
                                <span>💬 12 comments</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:shadow-md transition">
                        <div class="w-24 h-24 rounded-lg bg-gradient-to-br from-green-400 to-green-600 flex-shrink-0 flex items-center justify-center text-white text-2xl">🎨</div>
                        <div class="flex-1 min-w-0">
                            <span class="text-xs text-green-500 dark:text-green-400 font-medium">Design</span>
                            <h4 class="font-bold text-gray-900 dark:text-white mt-0.5">Building Beautiful UI Components</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">Discover how to create stunning user interfaces with reusable components and design patterns.</p>
                            <div class="flex items-center gap-3 mt-2 text-xs text-gray-400 dark:text-gray-500">
                                <span>📅 Jan 20, 2024</span>
                                <span>⏱️ 8 min read</span>
                                <span>💬 24 comments</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:shadow-md transition">
                        <div class="w-24 h-24 rounded-lg bg-gradient-to-br from-purple-400 to-purple-600 flex-shrink-0 flex items-center justify-center text-white text-2xl">🚀</div>
                        <div class="flex-1 min-w-0">
                            <span class="text-xs text-purple-500 dark:text-purple-400 font-medium">Performance</span>
                            <h4 class="font-bold text-gray-900 dark:text-white mt-0.5">Optimizing Laravel + Tailwind for Production</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">Tips and tricks to optimize your Laravel application with Tailwind CSS for maximum performance.</p>
                            <div class="flex items-center gap-3 mt-2 text-xs text-gray-400 dark:text-gray-500">
                                <span>📅 Feb 1, 2024</span>
                                <span>⏱️ 6 min read</span>
                                <span>💬 8 comments</span>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="text-xs text-gray-500 dark:text-gray-400 mt-6 mb-3">Grid cards</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-md transition">
                        <div class="h-36 bg-gradient-to-br from-pink-400 to-rose-600 flex items-center justify-center text-white text-3xl">📱</div>
                        <div class="p-4">
                            <span class="text-xs text-pink-500 font-medium">Mobile</span>
                            <h4 class="font-bold text-gray-900 dark:text-white mt-1 text-sm">Responsive Design Patterns</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">📅 Jan 22 • 7 min read</p>
                        </div>
                    </div>
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-md transition">
                        <div class="h-36 bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center text-white text-3xl">🔒</div>
                        <div class="p-4">
                            <span class="text-xs text-indigo-500 font-medium">Security</span>
                            <h4 class="font-bold text-gray-900 dark:text-white mt-1 text-sm">Authentication Best Practices</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">📅 Jan 25 • 9 min read</p>
                        </div>
                    </div>
                </div>

                <p class="text-xs text-gray-500 dark:text-gray-400 mt-6 mb-3">Compact list</p>
                <div class="divide-y divide-gray-200 dark:divide-gray-700 border border-gray-200 dark:border-gray-700 rounded-lg">
                    <a href="#" class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">How to Build a REST API with Laravel</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Backend • Jan 30 • 12 min read</p>
                        </div>
                        <span class="text-xs text-blue-500 font-medium ml-3">Read →</span>
                    </a>
                    <a href="#" class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">Understanding Vue 3 Composition API</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Frontend • Feb 2 • 15 min read</p>
                        </div>
                        <span class="text-xs text-blue-500 font-medium ml-3">Read →</span>
                    </a>
                    <a href="#" class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">Docker for Laravel Developers</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">DevOps • Feb 5 • 10 min read</p>
                        </div>
                        <span class="text-xs text-blue-500 font-medium ml-3">Read →</span>
                    </a>
                </div>

            {{-- Article Detail Layout --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow lg:col-span-2"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Article Detail Layout</h3>
                <div class="max-w-5xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                        {{-- Main Content --}}
                        <div class="lg:col-span-3">
                            {{-- Article Header --}}
                            <div class="mb-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="inline-block px-2.5 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">Technology</span>
                                    <span class="text-xs text-gray-400">•</span>
                                    <span class="text-xs text-gray-400">5 min read</span>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">Getting Started with Tailwind CSS in Laravel: A Complete Guide for Beginners</h2>
                                <div class="flex items-center gap-4 mt-4 text-sm text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center gap-2">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-sm font-bold">JD</div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">John Doe</p>
                                            <p class="text-xs text-gray-400">Senior Developer</p>
                                        </div>
                                    </div>
                                    <span class="text-gray-300 dark:text-gray-600">|</span>
                                    <span>📅 Jan 15, 2024</span>
                                </div>
                            </div>

                            {{-- Featured Image --}}
                            <div class="h-72 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 rounded-xl mb-8 flex items-center justify-center text-white text-5xl">🖼️</div>

                            {{-- Content --}}
                            <div class="max-w-none text-gray-700 dark:text-gray-300 space-y-5 text-sm leading-relaxed">
                                <p class="text-base">Tailwind CSS has become one of the most popular utility-first CSS frameworks for building modern web applications. When combined with Laravel, it provides a powerful toolkit for creating beautiful, responsive user interfaces without writing custom CSS.</p>

                                <h3 id="getting-started" class="text-xl font-bold text-gray-900 dark:text-white mt-8 pt-4 border-t border-gray-100 dark:border-gray-700">Getting Started</h3>
                                <p>Laravel ships with Tailwind CSS support out of the box through Vite. Simply run these commands to get started:</p>
                                <div class="bg-gray-900 dark:bg-gray-950 rounded-lg p-4 font-mono text-sm text-green-400">
                                    <div>npm install</div>
                                    <div>npm run dev</div>
                                </div>

                                <h3 id="components" class="text-xl font-bold text-gray-900 dark:text-white mt-8 pt-4 border-t border-gray-100 dark:border-gray-700">Component Architecture</h3>
                                <p>Organize your components in a modular way. Use Blade components for reusable UI elements and Tailwind classes for styling. This approach keeps your code clean and maintainable.</p>
                                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-5 border-l-4 border-blue-500">
                                    <p class="font-semibold text-blue-800 dark:text-blue-300 text-sm">💡 Pro Tip</p>
                                    <p class="text-blue-700 dark:text-blue-400 text-sm mt-1">Use <code class="px-1.5 py-0.5 bg-blue-100 dark:bg-blue-800/50 rounded text-xs font-mono">@apply</code> sparingly. Prefer utility classes directly in your HTML for better readability.</p>
                                </div>

                                <h3 id="conclusion" class="text-xl font-bold text-gray-900 dark:text-white mt-8 pt-4 border-t border-gray-100 dark:border-gray-700">Conclusion</h3>
                                <p>Building with Tailwind CSS and Laravel is a delightful experience. The combination of utility-first CSS and Blade components gives you the flexibility to create any design while maintaining clean, readable code.</p>
                            </div>

                            {{-- Tags --}}
                            <div class="flex flex-wrap items-center gap-2 mt-8 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <span class="text-xs text-gray-400">Tags:</span>
                                <span class="px-2.5 py-1 text-xs bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/30 cursor-pointer transition">Tailwind CSS</span>
                                <span class="px-2.5 py-1 text-xs bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/30 cursor-pointer transition">Laravel</span>
                                <span class="px-2.5 py-1 text-xs bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/30 cursor-pointer transition">Components</span>
                                <span class="px-2.5 py-1 text-xs bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/30 cursor-pointer transition">Web Dev</span>
                            </div>

                            {{-- Author Card --}}
                            <div class="flex items-center gap-4 mt-6 p-5 bg-gray-50 dark:bg-gray-700/30 rounded-xl">
                                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-lg font-bold flex-shrink-0">JD</div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900 dark:text-white">John Doe</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Senior Developer at TechCorp. Writing about Laravel, Tailwind CSS, and modern web development. 42 articles published.</p>
                                </div>
                                <div class="flex gap-2">
                                    <span class="w-8 h-8 rounded-full bg-white dark:bg-gray-600 flex items-center justify-center text-sm cursor-pointer hover:shadow transition">🐙</span>
                                    <span class="w-8 h-8 rounded-full bg-white dark:bg-gray-600 flex items-center justify-center text-sm cursor-pointer hover:shadow transition">🐦</span>
                                </div>
                            </div>

                            {{-- Comments --}}
                            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4">💬 Comments (3)</h4>
                                <div class="space-y-4">
                                    <div class="flex gap-3">
                                        <div class="w-9 h-9 rounded-full bg-green-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">AB</div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2"><span class="text-sm font-medium text-gray-900 dark:text-white">Alice Brown</span><span class="text-xs text-gray-400">2 days ago</span></div>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Great article! Very helpful for beginners getting started with Tailwind.</p>
                                            <button class="text-xs text-gray-400 hover:text-blue-500 mt-1">Reply</button>
                                        </div>
                                    </div>
                                    <div class="flex gap-3 ml-10">
                                        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">JD</div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2"><span class="text-sm font-medium text-blue-600 dark:text-blue-400">John Doe</span><span class="text-xs text-gray-400">1 day ago</span></div>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Thanks Alice! Glad you found it useful.</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <div class="w-9 h-9 rounded-full bg-purple-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">CK</div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2"><span class="text-sm font-medium text-gray-900 dark:text-white">Charlie Kim</span><span class="text-xs text-gray-400">5 hours ago</span></div>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Would love to see a follow-up on advanced component patterns!</p>
                                            <button class="text-xs text-gray-400 hover:text-blue-500 mt-1">Reply</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-3 mt-5">
                                    <div class="w-9 h-9 rounded-full bg-gray-400 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">?</div>
                                    <input type="text" placeholder="Write a comment..." class="flex-1 px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none" />
                                </div>
                            </div>
                        </div>

                        {{-- Sidebar: Table of Contents --}}
                        <div class="hidden lg:block">
                            <div class="sticky top-20 space-y-4">
                                <div class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-4">
                                    <h5 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">📑 Table of Contents</h5>
                                    <ul class="space-y-1.5 text-sm">
                                        <li><a href="#getting-started" class="text-blue-500 dark:text-blue-400 font-medium">Getting Started</a></li>
                                        <li><a href="#components" class="text-gray-500 dark:text-gray-400 hover:text-blue-500 transition">Component Architecture</a></li>
                                        <li><a href="#conclusion" class="text-gray-500 dark:text-gray-400 hover:text-blue-500 transition">Conclusion</a></li>
                                    </ul>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-4">
                                    <h5 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">🔗 Share</h5>
                                    <div class="flex gap-2">
                                        <span class="w-9 h-9 rounded-full bg-white dark:bg-gray-600 flex items-center justify-center text-sm cursor-pointer hover:shadow transition">🐙</span>
                                        <span class="w-9 h-9 rounded-full bg-white dark:bg-gray-600 flex items-center justify-center text-sm cursor-pointer hover:shadow transition">🐦</span>
                                        <span class="w-9 h-9 rounded-full bg-white dark:bg-gray-600 flex items-center justify-center text-sm cursor-pointer hover:shadow transition">💼</span>
                                        <span class="w-9 h-9 rounded-full bg-white dark:bg-gray-600 flex items-center justify-center text-sm cursor-pointer hover:shadow transition">📋</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Related Articles --}}
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4">📖 Related Articles</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-md transition cursor-pointer">
                                <div class="h-28 bg-gradient-to-br from-green-400 to-teal-600 flex items-center justify-center text-white text-3xl">🎨</div>
                                <div class="p-3">
                                    <h5 class="text-sm font-bold text-gray-900 dark:text-white">Building Beautiful UI Components</h5>
                                    <p class="text-xs text-gray-400 mt-1">Jan 20 • 8 min</p>
                                </div>
                            </div>
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-md transition cursor-pointer">
                                <div class="h-28 bg-gradient-to-br from-purple-400 to-indigo-600 flex items-center justify-center text-white text-3xl">🚀</div>
                                <div class="p-3">
                                    <h5 class="text-sm font-bold text-gray-900 dark:text-white">Optimizing for Production</h5>
                                    <p class="text-xs text-gray-400 mt-1">Feb 1 • 6 min</p>
                                </div>
                            </div>
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-md transition cursor-pointer">
                                <div class="h-28 bg-gradient-to-br from-orange-400 to-red-600 flex items-center justify-center text-white text-3xl">🔧</div>
                                <div class="p-3">
                                    <h5 class="text-sm font-bold text-gray-900 dark:text-white">Advanced Blade Patterns</h5>
                                    <p class="text-xs text-gray-400 mt-1">Feb 10 • 12 min</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection