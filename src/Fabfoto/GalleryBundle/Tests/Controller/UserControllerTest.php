<?php

namespace Fabfoto\GalleryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testAboutPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/toto-toto/about');

        $this->assertTrue($crawler->filter('html:contains("toto toto")')->count() > 0, "No user toto-toto");

    }
}
