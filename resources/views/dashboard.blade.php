<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Welcome back! <span class="font-bold capitalize ">{{Auth::check() ? Auth::user()->name : ''}}</span>
                </div>
            </div>
            <h5 class="text-lg font-bold my-3">My businesses:</h5>
            <table class="w-full shadow rounded-lg  p-5">
                <thead>
                <tr class="border border-2 bg-gray-400">
                    <th>#</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($businesses as $item)
                    <tr class="mx-auto text-center">
                        <td>{{$loop->iteration}}.</td>
                        <td><a href="{{route('business.show', ['business' => $item['id']])}}">{{$item['title']}}</a>
                        </td>
                        <td>{{$item['updated_at']->diffForHumans()}}</td>
                        <td>
                            <x-button-link @class([
                            'bg-amber-500']) :href="route('business.edit', ['business' => $item['id']])">
                            {{ __('Edit') }}
                            </x-button-link>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


            <h5 class="text-lg font-bold my-3">My ratings:)</h5>
            <table class="w-full shadow rounded-lg  p-5">
                <thead>
                <tr class="border border-2 bg-gray-400">
                    <th>#</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Rating</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ratings as $item)
                    <tr class="mx-auto text-center">
                        <td>{{$loop->iteration}}.</td>
                        <td><a href="{{route('business.show', ['business' => $item['business']])}}">{{$item['business']['title']}}</a>
                        </td>
                        <td>{{$item['created_at']->diffForHumans()}}</td>
                        <td>{{$item['rating']}}</td>
                        <td>
                            @can('rating-delete', $item)
                                <form action="{{route('rating.delete', ['business' => $item['business'], 'rating' => $item])}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <x-primary-button @class([
                                    'bg-red-700']) @class(['w-32 justify-center'])>
                                    {{ __('Delete') }}
                                    </x-primary-button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="py-2 px-3">
{{--                {{Paginator::setPageName('page_a')}}--}}
                {{ $ratings->links() }}
            </div>

        </div>
    </div>
</x-app-layout>

