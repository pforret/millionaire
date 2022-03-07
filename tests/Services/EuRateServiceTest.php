<?php

namespace Tests\Services;

use App\Services\EuRateService;
use Tests\TestCase;

class EuRateServiceTest extends TestCase
{

    public function test_get_rates(){
        $object = new EuRateService();
        $data = $object->get("EUR",10);
        $this->assertIsArray($data);
        $this->assertGreaterThanOrEqual(7,count($data), "at least 7 days found");
        $first_day=array_slice($data,0,1,true);
        print_r($first_day);
    }
}
