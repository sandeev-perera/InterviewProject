
@if (session('success'))
    <div class="mb-4 p-3 rounded bg-emerald-100 text-emerald-700">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="mb-4 p-3 rounded text-white bg-red-400">
        {{ session('error') }}
    </div>
@endif