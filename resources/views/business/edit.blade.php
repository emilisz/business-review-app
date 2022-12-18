<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit '{{ $business['title'] }}'
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="justify-center">
                <form action="{{route('business.update', $business->id)}}" method="post">
                    @method('put')
                    @csrf
                    <div class="w-2/3 bg-gray-200 rounded-lg flex flex-col gap-3 border p-5 mx-auto">
                        <x-input-label for="title">Title</x-input-label>
                        <x-text-input placeholder="..." value="{{ $business->title }}" name="title" @class(['px-3 py-2']) :error="$errors->has('title')" ></x-text-input>

                        <x-input-label for="description">Description</x-input-label>
                        <x-textarea-input placeholder="..."  name="description" @class(['px-3 py-2']) :error="$errors->has('description')" >{{ $business->description }}</x-textarea-input>

                        <x-input-label for="phone">Phone</x-input-label>
                        <x-text-input placeholder="..."  name="phone" value="{{ $business->phone }}" @class(['px-3 py-2']) :error="$errors->has('phone')" ></x-text-input>

                        <x-input-label for="address">Address</x-input-label>
                        <x-textarea-input placeholder="..."  name="address"  @class(['px-3 py-2']) :error="$errors->has('address')" >{{ $business->address }}</x-textarea-input>

                        <x-input-label for="employees">Employees</x-input-label>
                        <x-text-input placeholder="..."  name="employees" value="{{ $business->employees }}" @class(['px-3 py-2']) :error="$errors->has('employees')" ></x-text-input>

                        <div class="flex justify-end flex-row gap-3">
                            <x-button-link @class(['bg-gray-500 border border-black shadow']) :href="url()->previous()">
                            {{ __('Back') }}
                            </x-button-link>

                            <x-primary-button @class(['w-32 justify-center bg-green-600 border border-black shadow'])>
                            {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


