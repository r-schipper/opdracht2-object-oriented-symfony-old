<?php

namespace App\Tests\Entity;

use App\Entity\Accommodatie;
use App\ResponseHandler\ResponseHandler;
use PHPUnit\Framework\TestCase;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class ResponseHandlerTest extends TestCase
{
    public function testGetXmlResponse()
    {
        $response_handler = new ResponseHandler();
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new XmlEncoder()]
        );

        $accommodaties1 = new Accommodatie();
        $accommodaties1->setAccommodatie('Chalet Le Hameau des Marmottes');
        $accommodaties1->setLand('Frankrijk');
        $accommodaties1->setSkigebied('Les Trois Vallées');
        $accommodaties1->setPlaats('Les Menuires');
        $accommodaties1->setAfbeelding('https://www.chalet.nl/pic/cms/_imgcache/562x422-hoofdfoto_accommodatie-1.jpg');

        $accommodaties2 = new Accommodatie();
        $accommodaties2->setAccommodatie('Chalet Andrea');
        $accommodaties2->setLand('Oostenrijk');
        $accommodaties2->setSkigebied('Skicircus Saalbach / Hinterglemm / Leogang');
        $accommodaties2->setPlaats('Leogang');
        $accommodaties2->setAfbeelding('https://www.chalet.nl/pic/cms/_imgcache/562x422-hoofdfoto_accommodatie-4753.jpg');

        $accommodaties = [];
        array_push($accommodaties, $accommodaties1);
        array_push($accommodaties, $accommodaties2);

        $filename = "xml_file";
        $xml_attributes = ['accommodatie', 'land', 'skigebied', 'plaats', 'afbeelding'];
        $response = $response_handler->getXmlResponse($accommodaties, $filename, $xml_attributes);

        $accommodaties_from_xml = $serializer->deserialize($response->getContent(), 'App\Entity\Accommodatie[]', 'xml');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals($accommodaties_from_xml[0]->getAccommodatie(), 'Chalet Le Hameau des Marmottes');
        $this->assertEquals($accommodaties_from_xml[0]->getLand(), 'Frankrijk');
        $this->assertEquals($accommodaties_from_xml[0]->getSkigebied(), 'Les Trois Vallées');
        $this->assertEquals($accommodaties_from_xml[0]->getPlaats(), 'Les Menuires');
        $this->assertEquals($accommodaties_from_xml[0]->getAfbeelding(), 'https://www.chalet.nl/pic/cms/_imgcache/562x422-hoofdfoto_accommodatie-1.jpg');

        $this->assertEquals($accommodaties_from_xml[1]->getAccommodatie(), 'Chalet Andrea');
        $this->assertEquals($accommodaties_from_xml[1]->getLand(), 'Oostenrijk');
        $this->assertEquals($accommodaties_from_xml[1]->getSkigebied(), 'Skicircus Saalbach / Hinterglemm / Leogang');
        $this->assertEquals($accommodaties_from_xml[1]->getPlaats(), 'Leogang');
        $this->assertEquals($accommodaties_from_xml[1]->getAfbeelding(), 'https://www.chalet.nl/pic/cms/_imgcache/562x422-hoofdfoto_accommodatie-4753.jpg');
    }
}

?>
