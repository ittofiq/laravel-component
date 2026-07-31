{{-- Komponen Permission System dengan Tailwind CSS --}}
@props([
    'roles' => [],
])

<div class="space-y-4">
    @foreach($roles as $role)
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-900 dark:text-white">{{ $role['name'] }}</h3>
                <span class="text-xs bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 px-2 py-1 rounded">
                    {{ count($role['permissions']) }} permissions
                </span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @foreach($role['permissions'] as $permission)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 text-blue-500 rounded" {{ $permission['granted'] ? 'checked' : '' }} />
                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $permission['name'] }}</span>
                    </label>
                @endforeach
            </div>

            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 flex gap-2">
                <button class="flex-1 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition text-sm">Save</button>
                <button class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition text-sm">Reset</button>
            </div>
        </div>
    @endforeach
</div>
