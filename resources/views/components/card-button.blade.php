@props([
  'href' => '#',
  'hover' => 'Do action',
  'icon' => null,
  'borderClass' => 'border-2 border-dotted border-emerald-400',
  'hoverBgClass' => 'hover:bg-emerald-50',
  'iconClass' => 'h-24 w-24',
  'textClass' => 'text-emerald-600',
  'heightClass' => 'h-[50vh]',
])


<a href="{{ $href }}" class="block">
  <article class="group bg-white rounded-xl {{ $borderClass }} transition flex items-center justify-center {{ $heightClass }} relative {{ $hoverBgClass }}">
    <div class="flex flex-col items-center justify-center">
      @if ($icon)
        <img src="{{ asset($icon) }}" alt="icon" class="{{ $iconClass }}">
      @else
        <!-- fallback if no icon -->
        <div class="{{ $iconClass }} flex items-center justify-center text-emerald-500">+</div>
      @endif

      <span class="mt-4 text-lg font-semibold {{ $textClass }} opacity-0 group-hover:opacity-100 transition">
        {{ $hover }}
      </span>
    </div>
  </article>
</a>