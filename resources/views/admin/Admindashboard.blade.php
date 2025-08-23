@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">
  <x-show-success-error-messages/>

     <div class="bg-white rounded-xl shadow p-6 mb-2">
    <div class="flex items-center gap-6">
        <div class="h-20 w-20 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden">
            <img src="{{ asset('images/icons/admin-icon.svg') }}" 
                 alt="Admin Avatar" 
                 class="h-12 w-12">
        </div>

        <!-- User Info -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
            <p class="text-gray-600">{{ Auth::user()->email }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">

  <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
    <div class="h-12 w-12 rounded-lg bg-emerald-50 flex items-center justify-center">
      <img src="{{ asset('images/icons/manage-posts.svg') }}" alt="Posts" class="h-7 w-7">
    </div>
    <div>
      <p class="text-sm text-gray-500">Total Posts</p>
      <p class="text-2xl font-semibold text-gray-900">{{$posts}}</p>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
    <div class="h-12 w-12 rounded-lg bg-sky-50 flex items-center justify-center">
      <img src="{{ asset('images/icons/user-icon.svg') }}" alt="Painters" class="h-7 w-7">
    </div>
    <div>
      <p class="text-sm text-gray-500">Total Painters</p>
      <p class="text-2xl font-semibold text-gray-900">{{$users}}</p>
    </div>
  </div>

</div>


<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
  <x-card-button
    href="{{route('show.users')}}"
    hover="Manage Users"
    icon="images/icons/user-icon.svg"
    borderClass="border-2 border-dotted border-sky-400"
    hoverBgClass="hover:bg-sky-50"
    textClass="text-sky-600"
  />

  <x-card-button
    href="{{route('show.admin.products')}}"
    hover="Manage Posts"
    icon="images/icons/manage-posts.svg"
    borderClass="border-2 border-dotted border-emerald-400"
    hoverBgClass="hover:bg-emerald-50"
    textClass="text-emerald-600"
  />
</div>
@endsection
