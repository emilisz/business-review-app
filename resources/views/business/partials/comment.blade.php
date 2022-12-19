<div class="rounded shadow border p-3 text-gray-400 relative">
    <p class="">- {{$rating->user ? $rating->user->name : 'unknown'}}</p>
    <p class="text-gray-600">{{$rating->comment}}</p>
    <div class="flex justify-between">
        <p class="text-gray-400">{{round($rating->rating)}}{{str_repeat("⭐", round($rating->rating))}} </p>
        <div class="flex flex-row gap-2">
            <p>{{$rating->created_at->diffForHumans()}}</p>
            @can('rating-delete', $rating)
                <form
                    action="{{route('rating.delete',['rating'=> $rating])}}"
                    method="POST">
                    @method('delete')
                    @csrf
                    <x-primary-button @class([
                    'bg-red-700 w-6 justify-center'])>
                    x
                    </x-primary-button>
                </form>
            @endcan
        </div>

    </div>
</div>
