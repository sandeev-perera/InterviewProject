{{-- resources/views/components/search-box.blade.php --}}
@props([
    'action' => '',
    'placeholder' => 'Search...',
    'name' => 'search',
    'buttonLabel' => 'Search',
])

<form method="GET" action="{{ $action }}" class="w-full max-w-md">
  <div class="relative flex">
    {{-- Icon --}}
    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 pointer-events-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-4.35-4.35M11 5a6 6 0 100 12 6 6 0 000-12z" />
      </svg>
    </span>

    {{-- Input --}}
    <input
      type="text"
      name="{{ $name }}"
      value="{{ request($name) }}"
      placeholder="{{ $placeholder }}"
      class="flex-1 pl-10 pr-28 py-2 rounded-l-lg border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"
    />

    {{-- Submit Button --}}
    <button type="submit"
      class="absolute right-0 top-0 h-full px-4 rounded-r-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500">
      {{ $buttonLabel }}
    </button>

    @if(request($name))
      <a href="{{ url()->current() }}"
         class="absolute inset-y-0 right-20 flex items-center px-2 text-gray-400 hover:text-gray-600"
         aria-label="Clear search">
        ✕
      </a>
    @endif
  </div>
</form>
