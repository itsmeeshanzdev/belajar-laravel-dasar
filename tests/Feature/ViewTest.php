<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Shandika');
    }

    public function testNested()
    {
        $this->get('/world')
            ->assertSeeText('World Shandika');
    }

    public function testTemplate() {
        $this->view('hello', ['name' => 'Shandika'])
            ->assertSeeText('Hello Shandika');
    }
}
