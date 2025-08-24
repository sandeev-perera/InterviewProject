@extends('layouts.app')

@section('title', $user->name)

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">
    <x-show-success-error-messages/>
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <div class="flex items-center gap-6">
            <!-- Avatar -->
            <div class="h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center text-2xl font-bold text-gray-700">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <!-- User Info -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
                Posts created: <span class="font-semibold text-gray-800">{{ $posts->count() }}</span> 
            </div>
        </div>
    </div>

    <h3 class="text-xl font-bold text-gray-800 mb-4">{{$user->name}}s' Posts</h3>
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse ($posts as $post)
                <x-product-card 
    title="{{$post->title}}" 
    author="{{$user->name}}" 
    category="{{$post->category}}"
    image="{{ asset('storage/'. $post->image_path) }}"
    link="{{$post->id}}" 
    
/>
        @empty
            <p class="text-gray-500">{{$user->name}} has not posted any posts yet</p>
        @endforelse
    </section>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>

</div>
@endsection