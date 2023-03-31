<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{

    public function testIndex(): void
    {
        $client = static::createClient();
        
        // $client->followRedirects(true);

        $client->request('GET', '/post');
        $test = $client->getResponse();
        
        $myDebugVar = array(1, 2, 3);
        fwrite(STDERR, print_r($test, TRUE));
        // $this->assertTrue($client->getResponse()->isSuccessful());

        // $this->assertTrue($client->getResponse()->isRedirect('http://localhost/post'));

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        // $this->assertJson($client->getResponse()->getContent());
        // $this->assertJsonStringEqualsJsonString('{"key": "value"}', $client->getResponse()->getContent());
    }
}
