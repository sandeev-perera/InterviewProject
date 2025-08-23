@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">
    <x-show-success-error-messages/>
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <div class="flex items-center gap-6">
            <!-- Avatar -->
            <div class="h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center text-2xl font-bold text-gray-700">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <!-- User Info -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                <p class="text-gray-600">{{ Auth::user()->email }}</p>
                <p class="mt-2 text-sm text-gray-500">
                    <span class="font-semibold text-gray-800">{{ $posts->count() }}</span> Posts created
                </p>
            </div>
        </div>
    </div>

    <h3 class="text-xl font-bold text-gray-800 mb-4">My Posts</h3>
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <x-card-button
    href="{{ route('show.addPost') }}"
    hover="Add Post"
    icon="images/icons/add-button.svg"
    borderClass="border-2 border-dotted border-emerald-400"
    hoverBgClass="hover:bg-emerald-50"
    textClass="text-emerald-600"
/>
        @forelse ($posts as $post)
                <x-product-card 
    title="{{$post->title}}" 
    author="{{$post->user->name}}" 
    category="{{$post->category}}"
    image="{{ asset('storage/'. $post->image_path) }}"
    link="{{$post->id}}" 
    
/>
        @empty
            <p class="text-gray-500">You haven’t created any posts yet.</p>
        @endforelse
    </section>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>

</div>
@endsection
