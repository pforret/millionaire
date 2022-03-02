<?php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExchangeRateService
{
    // via https://github.com/exchangeratesapi/exchangeratesapi
    // URL: https://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist-90d.xml
    /*
    <?xml version="1.0" encoding="UTF-8"?>
    <gesmes:Envelope xmlns:gesmes="http://www.gesmes.org/xml/2002-08-01"
                     xmlns="http://www.ecb.int/vocabulary/2002-08-01/eurofxref">
        <gesmes:subject>Reference rates</gesmes:subject>
        <gesmes:Sender>
            <gesmes:name>European Central Bank</gesmes:name>
        </gesmes:Sender>
        <Cube>
            <Cube time="2022-03-01">
                <Cube currency="USD" rate="1.1162"/>
                <Cube currency="JPY" rate="128.15"/>
     */

    public function get(){
        $url="https://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist-90d.xml";
        $key="$url";
        if(Cache::get($key)){
            return Cache::get($key);
        }
        $xml=Http::get($url);
        $data=$this->xml_to_array($xml);
        $array=$data["Cube"]["Cube"];
        /*
                 $data["Cube"]["Cube"][0]
        => [
             "@attributes" => [
               "time" => "2022-03-02",
             ],
             "Cube" => [
               [
                 "@attributes" => [
                   "currency" => "USD",
                   "rate" => "1.1106",
                 ],
               ],
               [
                 "@attributes" => [
                   "currency" => "JPY",
                   "rate" => "128.08",
                 ],

         */
        Cache::add($key,$array,3600);
        return $array;
    }

    private function xml_to_array(string $xml_string): array
    {
        $xml = simplexml_load_string($xml_string, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        return json_decode($json,TRUE);
    }
}
