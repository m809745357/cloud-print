<?php

namespace Pkg6\cloudPrint\Tests\Printcenter;

use Pkg6\cloudPrint\Printcenter\Printer;
use Pkg6\cloudPrint\Tests\BaseTest;


class PrinterTest extends BaseTest
{
    public function methodPrivateParams($method, $private_params)
    {
        $app = $this->Printcenter();
        $client = $this->mockApiClient(Printer::class, $app);
        $data = json_decode($client->$method($private_params), true);
        $this->assertIsArray($data);
    }

    public function testStatus()
    {
        $private_params = [
            'deviceNo' => '',
        ];
        $this->methodPrivateParams('status', $private_params);
    }

    public function testPrint()
    {
        $private_params = [
            'deviceNo'     => '',
            'printContent' => '',
        ];
        $this->methodPrivateParams('print', $private_params);
    }

    public function testOrderState()
    {
        $private_params = [
            'deviceNo'   => '',
            'orderindex' => '',
        ];
        $this->methodPrivateParams('orderState', $private_params);
    }
}
