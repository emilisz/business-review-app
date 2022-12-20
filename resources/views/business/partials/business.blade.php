<div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg">
    <img
        class=" w-full h-60 md:h-60 object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg"
        src="{{$item->image_url ?: asset('img/placeholder.png')}}" alt=""/>
    <div class="p-6 flex flex-col justify-start">
        <a href="{{route('business.show', ['business' =>$item->id])}}"
           class="text-gray-900 text-xl font-medium mb-2">{{$item->title}}</a>
        <p class="text-gray-400">{{str_repeat("⭐", round($item->ratings_avg_rating))}}
            ({{round($item->ratings_count)}})</p>
        <p class=" text-red-500 text-base mb-4">
            {{substr($item->description, 0, 55)}}
        </p>
        <p class="text-gray-600 text-xs">Last
            updated {{ $item->updated_at->diffForHumans() }} </p>
    </div>
</div>
