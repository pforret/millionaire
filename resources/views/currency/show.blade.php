<x-app-layout>
    @section('page_title', "To be a " . $currency->name . " millionaire, you need " . round($last_rate) . "€")
    @section('page_subtitle', "1 000 000 " . $currency->symbol . " = " . round($last_rate) . "€")
    @section('page_url', $page_url)
    @section('page_img', $page_img)

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            To be a <b>{{ $currency->flag . " " . $currency->name }} millionaire</b>, you need {{number_format($last_rate,0,"."," ")}} &euro;
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div style="font-family: Nunito" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @include("components.sharethis")
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl font-semibold my-4">To be a millionaire in {{$currency->flag}} {{$currency->country}} ...</h2>
                    <img src="/storage/{{$currency->code}}.jpg" alt="To be a millionaire" style="max-width: 100%">
                    If you would want to be a millionaire in {{$currency->flag}} {{$currency->country}} , you need at least 1 000 000 {{$currency->symbol}}, which is <br><br>
                    <div class="grid md:grid-cols-5 gap-4">
                    @foreach($other_currencies as $other_currency)
                        @if($other_currency->code ?? "")
                            @if($other_currency->code <> $currency->code)
                                @if(in_array($other_currency->code,["USD","EUR"]) )
                                <div class="text-center m-2" style="font-family: Nunito;">
                                    <a href="/in/{{$other_currency->code}}"><b>
                                    <code>{{ number_format($last_rate * $other_currency->rate,0,"."," ") . " " . $other_currency->symbol}}</code><br>
                                    {{ $other_currency->flag ." ".$other_currency->name  }}</b></a>
                                </div>
                                @else
                                        <div class="text-center m-2" style="font-family: Nunito;">
                                            <a href="/in/{{$other_currency->code}}">
                                                <code>{{ number_format($last_rate * $other_currency->rate,0,"."," ") . " " . $other_currency->symbol}}</code><br>
                                                <i>{{ $other_currency->flag ." ".$other_currency->name  }}</i></a>
                                        </div>
                                    @endif

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
