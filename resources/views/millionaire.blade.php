<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Millionaire Leaderboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-5 gap-4">
                    @foreach($currencies as $currency)
                        <button class="text-center m-2" style="font-family: Nunito">
                            <a href="/in/{{$currency->code}}">
                            To be a <br />
                            <span class="text-xl">{{$currency->flag}}</span> {{$currency->name}}<br />
                            millionaire,<br />
                            you need <br/>
                            <span class="text-green-600 text-xl"><b>{{number_format(1000000 / $currency->rate,0,","," ")}} &euro;</b></span>
                            </a>
                        </button>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
