<?php

namespace Tests\Services;

use App\Services\UaRateService;
use PHPUnit\Framework\TestCase;

class UaRateServiceTest extends TestCase
{
    public function test_get_rates(){
        $object = new UaRateService();
        $data = $object->get("EUR",10);
        $this->assertIsArray($data);
        $this->assertGreaterThanOrEqual(7,count($data), "at least 7 days found");
        $first_day=array_slice($data,0,1,true);
        print_r($first_day);
    }

}
