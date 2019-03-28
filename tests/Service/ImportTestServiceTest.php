<?php

namespace Tests\App\Service;

use PHPUnit\Framework\TestCase;
use App\Service\ImportTestService;

class ImportTestServiceTest extends TestCase
{
    public function testTxt2csv() {
        $service = new ImportTestService();
        $txt = file_get_contents('tests/data/test.txt');
        $expected_csv = file_get_contents('tests/data/test.csv');

        $csv = $service->txt2csv($txt);
        // dump($csv);
        file_put_contents('tests/data/test.csv',$csv);
        //$this->assertEquals($expected_csv, $csv);
    }

    public function testFixText() {
        $service = new ImportTestService();

        $text = file_get_contents('tests/data/NumeroDePreguntaSinEstarSeguidaDePunto.txt');
        $expected_fixed = file_get_contents('tests/data/NumeroDePreguntaSinEstarSeguidaDePunto_corregido.txt');
        $current_fixed = $service->fixText($text);
        $this->assertEquals($expected_fixed, $current_fixed);

        $text = file_get_contents('tests/data/PuntosFinalesOlvidados.txt');
        $expected_fixed = file_get_contents('tests/data/PuntosFinalesOlvidados_corregido.txt');
        $current_fixed = $service->fixText($text);
        $this->assertEquals($expected_fixed, $current_fixed);
    }
}
