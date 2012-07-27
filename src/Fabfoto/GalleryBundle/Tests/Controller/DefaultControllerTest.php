<?php

namespace Fabfoto\GalleryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/news');

        $this->assertTrue($crawler->filter('html:contains("nouvelles")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("articles")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("fabbook")')->count() > 0);
    }
}
