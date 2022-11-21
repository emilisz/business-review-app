@if (session('status'))
    <div class="w-full border text-center bg-green-100 py-1 text-green-600">
        {{ session('status') }}
    </div>
@endif
