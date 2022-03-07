<?php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EuRateService extends BaseRateService
{
    // via https://github.com/exchangeratesapi/exchangeratesapi
    // URL: https://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist-90d.xml

    public function get($main="EUR",$days_back=5): array
    {
        $url="https://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist-90d.xml";
        $raw=$this->cachedGet($url);
        $data=$this->xmlToArray($raw);
        $return=[];
        $notBefore = date("Y-m-d",strtotime("now - $days_back days"));
        foreach($data["Cube"]["Cube"] as $day_rates){
            $date=$day_rates["@attributes"]["time"] ?? "";
            if(!$date)  continue;
            if($date < $notBefore) continue;
            $rates=[];
            $base_rate=1;
            foreach($day_rates["Cube"] as $currency_rate){
                $currency=$currency_rate["@attributes"]["currency"] ?? "";
                $rate=$currency_rate["@attributes"]["rate"] ?? 1;
                if($currency){
                    $rates[$currency]=$rate;
                    if($currency == $main){
                        $base_rate=$rate;
                    }
                }
            }
            $rates["EUR"]=1;
            // rescale to base currency
            foreach($rates as $currency => $rate){
                $rates[$currency]=$rate/$base_rate;
            }
            ksort($rates);
            $return[$date]=$rates;
        }
        return $return;
    }
}
