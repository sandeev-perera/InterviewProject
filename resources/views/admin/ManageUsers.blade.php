@extends("layouts.app")
@section('title', "Manage Users")
@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Painters</h1>
        <span class="text-sm text-gray-500">Total: {{ $painters->total() }}</span>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto bg-white shadow rounded-xl">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Joined</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Posts</th>
                    <th class="px-6 py-3 text-right text-sm font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($painters as $painter)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $painter->id }}</td>
                        <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $painter->name }}</td>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ $painter->email }}</td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            {{ $painter->created_at?->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-3 text-sm font-semibold text-emerald-600">
                            {{ $painter->posts_count }}
                        </td>
                        <td class="px-6 py-3 text-sm text-right">
                            <a href="{{route('show.customer.profile', ["id" => $painter->id])}}"
                               class="text-emerald-600 hover:text-emerald-800 font-medium">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                            No painters found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $painters->links() }}
    </div>
</div>
@endsection