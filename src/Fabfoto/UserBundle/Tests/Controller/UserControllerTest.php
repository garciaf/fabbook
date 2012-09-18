<?php

namespace Fabfoto\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testPrivatePage()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/login');
        
        $buttonCrawlerNode = $crawler->selectButton('login');
        
        $form = $buttonCrawlerNode->form();
        
        // submit the form
        $client->submit($form, array(
            '_username' => 'toto',
            '_password' => 'test', 
            '_remember_me' => true
        ));
        $crawler = $client->request('GET', '/user/');

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Username")')->count(), "The user form is not displayed");
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Fabbook User Admin")')->count(), "No user Title Fabbook User Admin");
        $this->assertTrue($crawler->filter('html:contains("toto")')->count() > 0, "No user toto-toto");
    }
}
