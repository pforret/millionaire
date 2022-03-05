<x-app-layout>
    @section('page_title', "To be a " . $currency->name . " millionaire, you need " . round($last_rate) . "€")

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            To be a <b>{{ $currency->flag . " " . $currency->name }} millionaire</b>, you need {{number_format($last_rate,0,"."," ")}} &euro;
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-lg font-semibold my-4">1 000 000 {{$currency->name}} = </h2>
                    If you would want to be a millionaire in {{$currency->flag}} {{$currency->country}} , you need the following budget:<br><br>
                    <div class="grid grid-cols-5 gap-4">
                    @foreach($other_currencies as $other_currency)
                        @if($other_currency->code ?? "")
                            @if($other_currency->code <> $currency->code)
                                <div>
                                    <code>{{ number_format($last_rate * $other_currency->rate,0,"."," ") . " " . $other_currency->symbol}}</code><br>
                                    <a href="/in/{{$other_currency->code}}">{{ $other_currency->flag ." ".$other_currency->name  }}</a>
                                </div>
                                @endif
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800">History</h2>
                    @include("components.chartjs")
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
