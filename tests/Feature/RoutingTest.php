<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get("/pzn")
            ->assertStatus(200)
            ->assertSeeText("Hello Programmer Zaman Now");
    }

    public function testRedirect()
    {
        $this->get("/youtube")
            ->assertRedirect("/pzn");
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product 1');

        $this->get('/products/2')
            ->assertSeeText('Product 2');

        $this->get('/products/1/items/XXX')
            ->assertSeeText('Product 1, Item XXX');

        $this->get('/products/1/items/YYY')
            ->assertSeeText('Product 1, Item YYY');
    }

    public function testParameterRegex()
    {
        $this->get('/categories/100')
            ->assertSeeText('Category 100');

            $this->get('/categories/shandika')
            ->assertSeeText('404 By Shandikadav');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/shandika')
            ->assertSeeText('User shandika');

            $this->get('/users/')
            ->assertSeeText('User 404');
    }
}
