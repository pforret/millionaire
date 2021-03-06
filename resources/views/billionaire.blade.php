<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Billionaire Leaderboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($currencies as $currency)
                        <li>To be a {{$currency->flag}} <b>{{$currency->name}}</b> billionaire, you need {{number_format(1000000000 / $currency->rate,0,","," ")}} &euro;</li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
