<?php

namespace App\Tests\Entity;

use App\Entity\Accommodatie;
use PHPUnit\Framework\TestCase;

class AccommodatieTest extends TestCase
{
    public function testGetAccommodaties()
    {
        $accommodaties = new Accommodatie();
        $accommodaties = $accommodaties->getAccommodaties();

        $this->assertEquals($accommodaties[0]->getAccommodatie(), 'Chalet Le Clos du Pré');
        $this->assertEquals($accommodaties[0]->getLand(), ' Frankrijk');
        $this->assertEquals($accommodaties[0]->getSkigebied(), 'Alpe d\'Huez - Le Grand Domaine');
        $this->assertEquals($accommodaties[0]->getPlaats(), 'Oz-en-Oisans');
        $this->assertEquals($accommodaties[0]->getAfbeelding(), 'https://www.chalet.nl/pic/cms/_imgcache/562x422-hoofdfoto_accommodatie-47.jpg');

        $this->assertEquals($accommodaties[4]->getAccommodatie(), 'Appartement Rocksresort');
        $this->assertEquals($accommodaties[4]->getLand(), ' Zwitserland');
        $this->assertEquals($accommodaties[4]->getSkigebied(), 'Flims-Laax-Falera');
        $this->assertEquals($accommodaties[4]->getPlaats(), 'Laax (bij Flims)');
        $this->assertEquals($accommodaties[4]->getAfbeelding(), 'https://www.chalet.nl/pic/cms/_imgcache/562x422-accommodaties-2516-26.jpg');
    }
}

?>
