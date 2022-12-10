<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Business rating app') }}
            </h2>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div class="flex flex-row gap-2">
                            <span>Order by: </span>
                            @if(($pos = strpos(last(request()->segments()), "=")) !== FALSE)
                                <span class="capitalize">
                                    {{ str_replace ("_", " ",substr(last(request()->segments()), $pos+1))}}
                                </span>
                            @else
                                Show all
                            @endif
                        </div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('order', 'ratings_avg_rating')">
                        {{ __('Ratings (avg rating)') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('order', 'updated_at')">
                        {{ __('Updated at') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('order', 'created_at')">
                        {{ __('Created at') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('home')">
                        {{ __('Show all') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>


        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-3 rounded justify-center">
                @foreach($businesses as $item)

                    <div class="">
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
                    </div>
                @endforeach
            </div>
            <div class="py-2 px-3">
                {{ $businesses->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

