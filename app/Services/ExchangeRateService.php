<?php

use Illuminate\Support\Facades\Http;

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
        $xml=Http::get($url);
        $object=simplexml_load_string($xml);
        $lists=$object->gesmes->
    }
}
