<?php

namespace Tests\App\Service;

use PHPUnit\Framework\TestCase;
use App\Service\ImportTestService;

class ImportTestServiceTest extends TestCase
{
    public function testTxt2csv() {
        $service = new ImportTestService();
        $txt = file_get_contents('tests/data/test1.txt');
        $expected_csv = file_get_contents('tests/data/test1.csv');

        $csv = $service->txt2csv($txt);
        dump($txt);
        $this->assertEquals($expected_csv, $csv);
    }
}
