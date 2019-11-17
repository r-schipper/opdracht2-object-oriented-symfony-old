<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class AccommodatieControllerTest extends WebTestCase
{
    public function testAccommodatiesHtml()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/accommodaties');

        $this->assertEquals(1, $crawler->filter('html div table thead th:contains("accommodatie")')->count());
        $this->assertEquals(1, $crawler->filter('html div table thead th:contains("land")')->count());
        $this->assertEquals(1, $crawler->filter('html div table thead th:contains("skigebied")')->count());
        $this->assertEquals(1, $crawler->filter('html div table thead th:contains("plaats")')->count());
        $this->assertEquals(1, $crawler->filter('html div table thead th:contains("afbeelding")')->count());

        $this->assertEquals(1, $crawler->filter('html div table tbody tr td:contains("Chalet Le Clos du Pré")')->count());
        $this->assertEquals(2, $crawler->filter('html div table tbody tr td:contains("Frankrijk")')->count());
        $this->assertEquals(1, $crawler->filter('html div table tbody tr td:contains("Alpe d\'Huez - Le Grand Domaine")')->count());
        $this->assertEquals(1, $crawler->filter('html div table tbody tr td:contains("Oz-en-Oisans")')->count());

        $this->assertContains('https://www.chalet.nl/pic/cms/_imgcache/562x422-hoofdfoto_accommodatie-47.jpg', $crawler->filter('img')->eq(0)->attr('src'));
        $this->assertContains('https://www.chalet.nl/pic/cms/_imgcache/562x422-hoofdfoto_accommodatie-1.jpg', $crawler->filter('img')->eq(1)->attr('src'));
        $this->assertContains('https://www.chalet.nl/pic/cms/_imgcache/562x422-hoofdfoto_accommodatie-4753.jpg', $crawler->filter('img')->eq(2)->attr('src'));
        $this->assertContains('https://www.chalet.nl/pic/cms/_imgcache/562x422-accommodaties-5211-5.jpg', $crawler->filter('img')->eq(3)->attr('src'));
        $this->assertContains('https://www.chalet.nl/pic/cms/_imgcache/562x422-accommodaties-2516-26.jpg', $crawler->filter('img')->eq(4)->attr('src'));
    }

    public function testAccommodatiesXml()
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new XmlEncoder()]
        );

        $client = static::createClient();
        $client->request('GET', '/accommodaties.xml');

        $accommodaties_from_xml = $serializer->deserialize($client->getResponse()->getContent(), 'App\Entity\Accommodatie[]', 'xml');

        $this->assertEquals($accommodaties_from_xml[0]->getAccommodatie(), 'Chalet Le Clos du Pré');
        $this->assertEquals($accommodaties_from_xml[0]->getLand(), ' Frankrijk');
        $this->assertEquals($accommodaties_from_xml[0]->getSkigebied(), 'Alpe d\'Huez - Le Grand Domaine');
        $this->assertEquals($accommodaties_from_xml[0]->getPlaats(), 'Oz-en-Oisans');
        $this->assertEquals($accommodaties_from_xml[0]->getAfbeelding(), 'https://www.chalet.nl/pic/cms/_imgcache/562x422-hoofdfoto_accommodatie-47.jpg');

        $this->assertEquals($accommodaties_from_xml[4]->getAccommodatie(), 'Appartement Rocksresort');
        $this->assertEquals($accommodaties_from_xml[4]->getLand(), ' Zwitserland');
        $this->assertEquals($accommodaties_from_xml[4]->getSkigebied(), 'Flims-Laax-Falera');
        $this->assertEquals($accommodaties_from_xml[4]->getPlaats(), 'Laax (bij Flims)');
        $this->assertEquals($accommodaties_from_xml[4]->getAfbeelding(), 'https://www.chalet.nl/pic/cms/_imgcache/562x422-accommodaties-2516-26.jpg');
    }
}

?>