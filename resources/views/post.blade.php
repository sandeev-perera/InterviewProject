@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- Layout: Image Left, Details Right -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

        <!-- Image Section -->
        <div>
            <img 
                src="{{ $post->image_path ? asset('storage/' . $post->image_path) : asset('images/placeholder.png') }}" 
                alt="{{ $post->title }}"
                class="w-full h-[80vh] object-compact rounded-xl shadow-md"
            >
        </div>

        <!-- Details Section -->
        <div class="flex flex-col gap-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $post->title }}</h1>
                <p class="text-gray-500 mt-1">By <a class="text-blue-400" href="{{route('show.customer.profile', ['id'=>$post->user_id])}}">{{ $post->user->name}}</a></p>
            </div>

            <!-- Category & Year -->
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700">
                    {{ $post->category }}
                </span>
                <span class="text-gray-600 text-sm">Painted in {{ $post->painted_year }}</span>
            </div>

            <!-- Description -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Description</h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $post->description }}
                </p>
            </div>

            <!-- Actions -->
            <div class="flex gap-4 mt-4">
  @can('update', $post)
    <a href="{{ route('show.edit.post', $post) }}"
       class="px-5 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
      Edit Post
    </a>
  @endcan

  @can('delete', $post)
    <form action="{{ route('delete.post', $post) }}" method="POST"
          onsubmit="return confirm('Are you sure you want to delete this post?');" class="inline">
      @csrf
      @method('DELETE')
      <button type="submit"
              class="px-5 py-2 bg-red-700 text-white rounded-lg hover:bg-red-600 transition">
        Delete Post
      </button>
    </form>
  @endcan
</div>
        </div>
    </div>

</div>
@endsection
