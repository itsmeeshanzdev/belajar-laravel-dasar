<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testGet()
    {
        $this->get('/controller/hello/Shandika')
            ->assertSeeText('Halo Shandika');
    }
}
