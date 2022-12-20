<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $business->title }}
            <p class="text-gray-400 flex flex-row gap-2">{{str_repeat("⭐", round($business->ratings_avg_rating))}}
                ({{round($business->ratings_count)}})</p>
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl bg-white mx-auto">
            <div class="grid md:grid-cols-3 gap-2">
                <img class=" w-full h-60 md:h-full object-cover rounded-t-lg md:rounded-none md:rounded-l-lg"
                     src="{{$business->image_url ?: asset('img/placeholder.png')}}" alt=""/>
                <div class="md:col-span-2 sm:px-6 lg:px-8">
                    <div class="p-3">
                        <p>{{ $business->description }}</p>
                    </div>

                    <div class="border-l p-2">
                        <h5 class="font-semibold border-b">Contact info:</h5>
                        @if(auth()->check() && (auth()->user()->isPremium() || auth()->user()->isOwner($business->id)))
                            <div class="p-2">
                                <div class="flex flex-justify-between">
                                    {{__('Phone')}}: <span class="font-semibold pl-3">{{$business->phone}}</span>
                                </div>
                                <div class="flex flex-justify-between">
                                    {{__('Address')}}: <span class="font-semibold pl-3">{{$business->address}}</span>
                                </div>
                                <div class="flex flex-justify-between">
                                    {{__('Employees')}}: <span
                                        class="font-semibold pl-3">{{$business->employees}}</span>
                                </div>
                            </div>
                        @else
                            <div
                                class="py-8 px-3 bg-white bg-opacity-40 backdrop-blur-md rounded drop-shadow-lg font-sans">
                                Premium content visible only to
                                <a class="text-blue-700 underline" href="{{route('payment.create')}}">premium users</a>
                            </div>
                        @endif
                    </div>

                </div>
            </div>


        </div>

        <div class="justify-end flex flex-row gap-4 p-3">
            <x-button-link @class([
            'bg-gray-500']) :href="url()->previous()">
            {{ __('Back') }}
            </x-button-link>
            @can('business-update', $business)
                <x-button-link @class([
                'bg-amber-500']) :href="route('business.edit', $business)">
                {{ __('Edit') }}
                </x-button-link>
            @endcan

            @can('business-delete', $business)
                <form action="{{route('business.delete', $business)}}" method="POST">
                    @method('delete')
                    @csrf
                    <x-primary-button @class([
                    'bg-red-700']) @class(['w-32 justify-center'])>
                    {{ __('Delete') }}
                    </x-primary-button>
                </form>
            @endcan
        </div>


        <div class="max-w-7xl mx-auto my-6 flex flex-col gap-2">
            <div class="p-3">
                <h2 class="text-lg">Comments</h2>
                @include('business.partials.create-comment-form')
            </div>

            <div class="flex flex-col gap-2">
                @foreach($ratings as $rating)
                    @include('business.partials.comment')
                @endforeach
            </div>

            <div class="py-3">
                {{$ratings->links()}}
            </div>

        </div>

    </div>
</x-app-layout>

