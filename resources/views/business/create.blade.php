<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new business') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="justify-center">
                <form action="{{route('business.store')}}" method="POST">
                    @csrf
                    <div class="w-2/3 bg-gray-200 rounded-lg flex flex-col gap-3 border p-5 mx-auto">
                        <x-input-label for="title">Title</x-input-label>
                        <x-text-input placeholder="..." value="{{old('title')}}" name="title" @class(['px-3 py-2']) :error="$errors->has('title')" ></x-text-input>

                        <x-input-label for="description">Description</x-input-label>
                        <x-textarea-input placeholder="..."  name="description" @class(['px-3 py-2']) :error="$errors->has('description')" >{{old('description')}}</x-textarea-input>

                        <x-input-label for="phone">Phone</x-input-label>
                        <x-text-input placeholder="..."  name="phone" @class(['px-3 py-2']) :error="$errors->has('phone')" >{{old('phone')}}</x-text-input>

                        <x-input-label for="address">Address</x-input-label>
                        <x-textarea-input placeholder="..."  name="address" @class(['px-3 py-2']) :error="$errors->has('address')" >{{old('address')}}</x-textarea-input>

                        <x-input-label for="employees">Employees</x-input-label>
                        <x-text-input placeholder="..."  name="employees" @class(['px-3 py-2']) :error="$errors->has('employees')" >{{old('employees')}}</x-text-input>

                        <div class="flex justify-end flex-row gap-3">
                            <x-button-link @class(['bg-gray-500  border-black shadow']) :href="url()->previous()">
                            {{ __('Back') }}
                            </x-button-link>

                            <x-primary-button @class(['w-32 justify-center bg-green-600  border-black shadow'])>
                            {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
