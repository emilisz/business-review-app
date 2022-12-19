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
                    @if($latestPayment)
                        <p class="text-gray-500 text-sm">Premium is valid till {{$latestPayment->valid_till}}</p>
                    @endif
                </div>
            </div>
            <h5 class="text-lg font-bold my-3">My businesses:</h5>
            <table class="w-full shadow rounded-lg  p-5">
                <thead>
                <tr class="border border-2 bg-gray-400">
                    <th>#</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($businesses as $item)
                    <tr class="mx-auto text-center">
                        <td>{{$loop->iteration}}.</td>
                        <td>
                            <a class="font-bold underline"
                               href="{{route('business.show', ['business' => $item->id])}}">{{$item->title}}
                                ({{$item->ratings_count}})</a>
                        </td>
                        <td>{{$item->created_at->diffForHumans()}}</td>
                        <td>
                            <x-button-link @class([
                            'bg-amber-500']) :href="route('business.edit', ['business' => $item->id])">
                            {{ __('Edit') }}
                            </x-button-link>
                        </td>
                        <td>
                            @can('business-delete', $item)
                                <form action="{{route('business.delete', ['business' => $item->id])}}" method="POST">
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

            <div class="py-3">
                {{ $businesses->links() }}
            </div>


            <h5 class="text-lg font-bold my-3">My ratings:</h5>
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
                        <td>
                            <a class="font-bold underline" href="{{route('business.show', ['business' => $item->business])}}">{{$item->business->title}}</a>
                        </td>
                        <td>{{$item->created_at->diffForHumans()}}</td>
                        <td>{{$item->rating}}</td>
                        <td>
                            @can('rating-delete', $item)
                                <form
                                    action="{{route('rating.delete', ['rating' => $item])}}"
                                    method="POST">
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

            <div class="py-3">
                {{ $ratings->links() }}
            </div>


            <h5 class="text-lg font-bold my-3">My payments:</h5>
            <table class="w-full shadow rounded-lg  p-5">
                <thead>
                <tr class="border border-2 bg-gray-400">
                    <th>#</th>
                    <th>Created</th>
                    <th>Valid_till</th>
                    <th>Method</th>
                    <th>Amount paid</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $item)
                    <tr class="mx-auto text-center">
                        <td>{{$loop->iteration}}.</td>
                        <td>
                            {{$item->created_at}}
                        </td>
                        <td>{{$item->valid_till}}</td>
                        <td>{{$item->payment_method}}</td>
                        <td> {{$item->amount}} &euro;
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="py-3">
                {{ $payments->links() }}
            </div>

        </div>
    </div>
</x-app-layout>

