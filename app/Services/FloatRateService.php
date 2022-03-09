<?php

namespace App\Services;

class FloatRateService extends BaseRateService
{

    public function get($main="EUR",$days_back=0): array
    {
        $url="https://www.floatrates.com/daily/eur.json";
        $raw=$this->cachedGet($url);
        $data = json_decode($raw,true);
        $rates=[];
        $last_date="";
        foreach ($data as $raw_rate){
            $currency = $raw_rate["code"] ?? "";
            $rate = $raw_rate["rate"] ?? 1;
            $last_date=$raw_rate["date"];
            if($currency){
                $rates[$currency]=$rate;
            }
        }
        $date=date("Y-m-d",strtotime($last_date));
        ksort($rates);
        return [$date => $rates];
    }
}
