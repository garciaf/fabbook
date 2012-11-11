<?php

namespace Fabfoto\GalleryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/news');

        $this->assertTrue($crawler->filter('html:contains("Pensées")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("Fabbook")')->count() > 0);
    }
        public function testAlbumsPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/albums');

        $this->assertTrue($crawler->filter('html:contains("Album")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("Comment")')->count() > 0);
    }
    public function testBlogPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog');

        $this->assertTrue($crawler->filter('html:contains("Blog")')->count() > 0);
    }
}
