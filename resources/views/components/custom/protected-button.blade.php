{{-- Level 7: Protected Button (Permission-based) --}}
@props(['permission' => null, 'disabled' => false])

@can($permission)
  {{-- Jika user punya permission --}}
  <x-ui.button {{ $attributes }}>
    {{ $slot }}
  </x-ui.button>
@else
  {{-- Jika user tidak punya permission --}}
  <x-ui.button disabled {{ $attributes }}>
    {{ $slot }}
  </x-ui.button>
@endcan
