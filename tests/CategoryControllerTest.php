<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{

    public function testIndex(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/category');
        // $test = $client->getResponse();
        
        // fwrite(STDERR, print_r($test, TRUE));

        // $this->assertTrue($client->getResponse()->isSuccessful());

        // $this->assertTrue($client->getResponse()->isRedirect('http://localhost/category'));

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testNew(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('POST', '/category/',
        [
            "title" => "test",
            "content" => "testestestest",
            "category" => null
        ]);

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testFind(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/category/1');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testUpdate(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('PUT', '/category/1',
        [
            "title" => "test",
            "content" => "testestestest",
            "category" => null
        ]);

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testDelete(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('DELETE', '/category/1');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }
}
