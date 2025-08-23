@props([
  'title' => 'Product Title',
  'author' => 'Unknown',
  'category' => 'Category',
  'image' => null,
  'link' => '#',
])

<a href="{{route('show.singlePost', ["post"=> $link])}}">
<article class="group bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition overflow-hidden h-[50vh]">

        <div class="relative">
            <img
                src="{{ $image }}"
                alt="{{ $title }}"
                class="h-48 w-full object-cover" />
        </div>
        <div class="p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h3 class="text-gray-900 font-semibold">{{ $title}}</h3>
                    <p class="text-gray-500 text-sm">By: {{ $author}}</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                    {{ $category}}
                </span>
            </div>
        </div>
</article>
</a>