<x-app-layout>
    @section('page_title', "To be a " . $currency->name . " millionaire")

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            To be a <b>{{ $currency->flag . " " . $currency->name }} millionaire</b>, you need {{$last_rate}} &euro;
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

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
