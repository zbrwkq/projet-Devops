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
        // $test = $client->getResponse();
        
        // fwrite(STDERR, print_r($test, TRUE));

        // $this->assertTrue($client->getResponse()->isSuccessful());

        // $this->assertTrue($client->getResponse()->isRedirect('http://localhost/post'));

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testNew(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('POST', '/post/',
        [
            "title" => "test",
            "content" => "testestestest",
            "category" => null
        ]);

        $test = $client->getResponse();
        fwrite(STDERR, print_r($test, TRUE));

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }
}
