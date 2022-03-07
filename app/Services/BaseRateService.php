<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class BaseRateService
{

    protected function cachedGet(string $url, $seconds=3600*6){
        $cache_id="BODY:$url";
        if(Cache::get($cache_id) ?? ""){
            return Cache::get($cache_id);
        }
        $raw = Http::get($url)->body();
        Cache::put($cache_id,$raw,$seconds);
        return $raw;
    }

    protected function xmlToArray(string $xml_string): array
    {
        $xml = simplexml_load_string($xml_string, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        return json_decode($json,TRUE);
    }

}
