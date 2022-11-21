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
                        <td><a href="{{route('business.show', $item)}}">{{$item->title}}</a></td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <x-button-link @class(['bg-amber-500']) :href="route('business.edit', ['business' => $item])">
                            {{ __('Edit') }}
                            </x-button-link>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="py-2 px-3">
                {{ $businesses->links() }}
            </div>

        </div>
    </div>
</x-app-layout>

