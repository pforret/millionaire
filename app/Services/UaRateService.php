<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UaRateService extends BaseRateService
{

    public function get($main="EUR",$days_back=0): array
    {
        $return=[];
        for($back=0;$back<$days_back;$back++){
            $dateYMD=date("Ymd",strtotime("now - $back days"));
            $date=date("Y-m-d",strtotime("now - $back days"));
            $url="https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?date=$dateYMD&json";
            if($back>1){
                //$raw=$this->cachedGet($url,3600*24*30);
                $raw=Http::get($url);
            } else {
                //$raw=$this->cachedGet($url,1800);
                $raw=Http::get($url);
            }
            /*
             * [
                {
                "r030":36,"txt":"Австралійський долар","rate":21.261,"cc":"AUD","exchangedate":"06.03.2022"
                 }
                ,{
                "r030":124,"txt":"Канадський долар","rate":23.0453,"cc":"CAD","exchangedate":"06.03.2022"
                 }
                ,
             */
            $original_rates=json_decode($raw,true);
            $rates=[];
            $base_rate=1;
            foreach($original_rates as $original_rate){
                $currency = $original_rate["cc"] ?? "";
                $rate     = $original_rate["rate"] ?? 1;
                if($currency){
                    $rates[$currency] = $rate;
                    if($currency == $main){
                        $base_rate = $rate;
                    }
                }
            }
            $rates["UAH"]=1;
            foreach($rates as $currency => $rate){
                $rates[$currency] = $base_rate/$rate;
            }
            ksort($rates);
            $return[$date]=$rates;
        }
        return $return;
    }

}
