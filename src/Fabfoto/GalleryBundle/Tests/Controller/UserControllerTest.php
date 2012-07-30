<?php

namespace Fabfoto\GalleryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase {

    public function testAboutPage() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fabien-garcia/about');

        $this->assertTrue($crawler->filter('html:contains("Fabien GARCIA")')->count() > 0, "No user fabien-garcia");
        
    }
}
