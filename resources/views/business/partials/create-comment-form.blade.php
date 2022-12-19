@auth
    <form action="{{route('rating.store', ['business' => $business->id])}}" method="POST">
        @csrf
        <div class="w-full flex flex-col gap-3">
            <x-input-label for="comment">Comment</x-input-label>
            <x-textarea-input placeholder="write comment as {{Auth::user()->name}}.." name="comment"
                              @class([
            'px-3 py-2']) :error="$errors->has('comment')" >{{old('comment')}}</x-textarea-input>
            <x-input-label for="rating">Rating</x-input-label>
            <select name="rating" id="rating">
                @for($i=1; $i<=5;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
            <x-primary-button @class([
            'w-32 justify-center bg-green-600 border-black shadow'])>
            {{ __('Send') }}
            </x-primary-button>
        </div>
    </form>
@endauth
@guest
    <p>To write comments and rate please <a class="underline text-sky-700" href="{{route('login')}}">Log
            in </a>first </p>
@endguest
