@extends('layouts.app')

@section('title', 'Update Post')

@section('content')
<div class="max-w-3xl mx-auto p-6">
  <h1 class="text-2xl font-semibold mb-6">Update Post</h1>

  @if (session('status'))
    <div class="mb-4 rounded-md bg-green-50 p-3 text-green-700">
      {{ session('status') }}
    </div>
  @endif

  {{-- Validation errors --}}
  @if ($errors->any())
    <div class="mb-6 rounded-md bg-red-50 p-4 text-red-700">
      <p class="font-medium mb-2">Please fix the following:</p>
      <ul class="list-disc ml-5 space-y-1">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- IMPORTANT: pass the post id to the update route --}}
  <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PATCH')

    {{-- Title --}}
    <div>
      <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
      <input
        type="text"
        id="title"
        name="title"
        maxlength="40"
        value="{{ old('title', $post->title) }}"
        class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('title') border-red-500 @enderror"
        placeholder="Enter title">
      @error('title')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    {{-- Category --}}
    <div>
      <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
      <select
        id="category"
        name="category"
        class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('category') border-red-500 @enderror">
        @php $cats = ['Educational','Authentic','General']; @endphp
        <option value="" disabled {{ old('category', $post->category) ? '' : 'selected' }}>Select a category</option>
        @foreach ($cats as $cat)
          <option value="{{ $cat }}" {{ old('category', $post->category) === $cat ? 'selected' : '' }}>
            {{ $cat }}
          </option>
        @endforeach
      </select>
      @error('category')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    {{-- Year --}}
    <div>
      <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
      <input
        type="number"
        id="year"
        name="year"
        min="1500"
        max="{{ now()->year }}"
        value="{{ old('year', $post->painted_year) }}"
        class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('year') border-red-500 @enderror"
        placeholder="e.g. 2020">
      @error('year')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    {{-- Photo (optional on update) --}}
    <div>
      <label for="photo" class="block text-sm font-medium text-gray-700">Photo (PNG, JPG, max 3MB)</label>
      <input
        type="file"
        id="photo"
        name="photo"
        accept=".png,.jpg,.jpeg"
        class="mt-1 block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 @error('photo') border-red-500 @enderror">
      @error('photo')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror

      {{-- Current image --}}
      <div class="mt-3">
        <p class="text-sm text-gray-500 mb-2">Current image:</p>
        <img
          src="{{ $post->image_path ? asset('storage/'.$post->image_path) : asset('images/placeholder.png') }}"
          alt="Current image"
          class="h-40 w-full object-cover rounded-lg border"
        />
      </div>

      {{-- Live preview of new upload (if chosen) --}}
      <div class="mt-3">
        <img id="preview" src="#" alt="" class="hidden h-40 w-full object-cover rounded-lg border" />
      </div>
    </div>

    {{-- Description --}}
    <div>
      <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
      <textarea
        id="description"
        name="description"
        rows="6"
        maxlength="10000"
        class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror"
        placeholder="Write a description...">{{ old('description', $post->description) }}</textarea>
      @error('description')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    {{-- Actions --}}
    <div class="flex items-center justify-end gap-3">
      <a href="{{ url()->previous() }}" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
        Cancel
      </a>
      <button type="submit"
        class="inline-flex items-center px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
        Update Post
      </button>
    </div>
  </form>
</div>

{{-- tiny preview script --}}
<script>
  const input = document.getElementById('photo');
  const preview = document.getElementById('preview');
  input?.addEventListener('change', () => {
    const [file] = input.files || [];
    if (!file) { preview.classList.add('hidden'); return; }
    const url = URL.createObjectURL(file);
    preview.src = url;
    preview.classList.remove('hidden');
  });
</script>
@endsection
