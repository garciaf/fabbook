<?php

namespace Fabfoto\I18nBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {

    public function testRedirection() {
        $client = static::createClient(array(), array(
                    'HTTP_HOST' => 'en.example.com',
                    'HTTP_USER_AGENT' => 'MySuperBrowser/1.0',
                ));

        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isRedirect('/news'), 'Desktop redirection failed');
    }
    public function testMobileRedirection() {
        $client = static::createClient(array(), array(
                    'HTTP_HOST' => 'en.example.com',
                    'HTTP_USER_AGENT' => 'Mozilla/5.0 (Linux; U; Android 2.1-update1; fr-fr; GTI9000 Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17',
                ));

        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isRedirect('/mobile/'), 'Mobile redirection failed');
    }

}
