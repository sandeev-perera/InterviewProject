@extends('layouts.app')

@section('title', $category)

@section('content')
<div class="max-w-7xl mx-auto p-6">
  <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse ($posts as $post)
     <x-product-card 
    title="{{$post->title}}" 
    author="{{$post->user->name}}" 
    category="{{$post->category}}"
    image="{{ asset('storage/'. $post->image_path) }}"
    link="{{$post->id}}" 
/>
     @empty
      <p class="text-gray-500">No posts for this category yet..</p>
    @endforelse
  </section>
  <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection