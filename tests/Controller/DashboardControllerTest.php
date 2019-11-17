<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardControllerTest extends WebTestCase
{
    public function testDashboardHtml()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(1, $crawler->filter('html div h1:contains("Chalet.nl Praktijkopdracht")')->count());
        $this->assertEquals(1, $crawler->filter('html div ul li a:contains("accommodaties")')->count());
    }
}

?>