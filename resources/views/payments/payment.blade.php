<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Choose payment method') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center p-6 text-lg">
                <h2>{{__('Buy premium plan to get unlimited access to businesses information '). $premiumDays. ' Days' }}</h2>
                @if($latestPayment)
                    <p class="text-gray-500 text-sm">You already purchased premium which is valid
                        till {{$latestPayment->valid_till}} . Additional purchase will extend your premium by
                        {{$premiumDays}} days </p>
                @endif
            </div>
            <div class="grid lg:grid-cols-2 gap-3 rounded justify-center">
                @foreach($providers as $provider)
                    <form method="POST" action="{{ route('payment.store') }}">
                        @csrf
                        <input type="text" name="payment_method" value="{{$provider}}" hidden>
                        <x-primary-button @class([
                        'w-full py-4 justify-center bg-green-600 border-black shadow']) onclick="event.preventDefault();
                        this.closest('form').submit();">
                        <span class="capitalize text-lg">{{$provider}} ({{$premiumPrice}} &euro;)</span>
                        </x-primary-button>
                    </form>
                @endforeach

            </div>

        </div>
    </div>
</x-app-layout>

