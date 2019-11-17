<?php

namespace App\Tests\Entity;

use App\Entity\Accommodatie;
use App\FileHandler\CsvHandler;
use PHPUnit\Framework\TestCase;

class CsvHandlerTest extends TestCase
{
    public function testCsvToArray()
    {
        $accommodaties = new Accommodatie();
        $csv_handler = new CsvHandler();

        $accommodaties = $csv_handler->csvToArray($accommodaties->getAccommodatiesCsvLocation());

        $this->assertEquals($accommodaties[0]['Accommodatie'], 'Chalet Le Clos du Pré');
        $this->assertEquals($accommodaties[0]['Land'], ' Frankrijk');
        $this->assertEquals($accommodaties[0]['Skigebied'], 'Alpe d\'Huez - Le Grand Domaine');
        $this->assertEquals($accommodaties[0]['Plaats'], 'Oz-en-Oisans');
        $this->assertEquals($accommodaties[0]['Afbeelding'], 'https://www.chalet.nl/pic/cms/_imgcache/562x422-hoofdfoto_accommodatie-47.jpg');

        $this->assertEquals($accommodaties[4]['Accommodatie'], 'Appartement Rocksresort');
        $this->assertEquals($accommodaties[4]['Land'], ' Zwitserland');
        $this->assertEquals($accommodaties[4]['Skigebied'], 'Flims-Laax-Falera');
        $this->assertEquals($accommodaties[4]['Plaats'], 'Laax (bij Flims)');
        $this->assertEquals($accommodaties[4]['Afbeelding'], 'https://www.chalet.nl/pic/cms/_imgcache/562x422-accommodaties-2516-26.jpg');
    }
}

?>
