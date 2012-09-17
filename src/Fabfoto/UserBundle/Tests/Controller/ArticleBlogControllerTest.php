<?php

namespace Fabfoto\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

class ArticleBlogTest extends WebTestCase
{
    public function testNewBlogPage()
    {
        $client = $this->getAuthenticatedClient();
        
        $crawler = $client->request('GET', '/writer/blog/new');
        
        $this->assertGreaterThan(0, $crawler->filter('html:contains("content")')->count(), "The user form is not displayed");
        
    }
    /**
     * Creates a Client.
     *
     *
     * @return Client A Client instance
     */
    protected function getAuthenticatedClient(){
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
        return $client;
    }
}
