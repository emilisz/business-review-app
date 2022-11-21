<x-app-layout>
    <x-slot name="header">
       <div class="flex justify-between">
           <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               {{ __('Business rating app') }}
           </h2>
       </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-3 rounded justify-center">
                @foreach($businesses as $item)

                    <div class="">
                        <div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg">
                            <img class=" w-full h-60 md:h-60 object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg" src="{{$item['image_url'] ?: asset('img/placeholder.png')}}" alt="" />
                            <div class="p-6 flex flex-col justify-start">
                                <a href="{{route('business.show', ['business' =>$item['id']])}}" class="text-gray-900 text-xl font-medium mb-2">{{$item['title']}}</a>
                                <p class="text-gray-400">{{round($item['avg_rating'])}}{{str_repeat("⭐", round($item['avg_rating']))}}</p>
                                <p class=" text-red-500 text-base mb-4">
                                   {{substr($item['description'], 0, 55)}}
                                </p>
                                <p class="text-gray-600 text-xs">Last updated {{ \Carbon\Carbon::parse($item['updated_at'])->diffForHumans() }} </p>
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

