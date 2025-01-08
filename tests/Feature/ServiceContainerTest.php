<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ServiceContainerTest extends TestCase
{
    public function testDependency(){
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind() {
        
        // $person = $this->app->make(Person::class);
        // self::assertNotNull($person);

        $this->app->bind(Person::class, function(){
            return new Person("Shandika", "Ardiansyah");
        });

        $person1 = $this->app->make(Person::class); 
        $person2 = $this->app->make(Person::class); 

        self::assertEquals('Shandika', $person1->firstName);
        self::assertEquals('Shandika', $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton() {
        $this->app->singleton(Person::class, function(){
            return new Person("Shandika", "Ardiansyah");
        });

        $person1 = $this->app->make(Person::class); 
        $person2 = $this->app->make(Person::class); 

        self::assertEquals('Shandika', $person1->firstName);
        self::assertEquals('Shandika', $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testInstance() {
        $person = new Person("Shandika", "Ardiansyah");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); 
        $person2 = $this->app->make(Person::class); 

        self::assertEquals('Shandika', $person1->firstName);
        self::assertEquals('Shandika', $person2->firstName);
        self::assertSame($person1, $person2);
    }

    // public function testDependencyInjection(){
    //     $this->app->singleton(Foo::class, function($app){
    //         return new Foo();
    //     });

    //     $foo = $this->app->make(Foo::class);
    //     $bar = $this->app->make(Bar::class);
        

    //     self::assertSame($foo, $bar->foo);
    // }

    public function testHelloService(){
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Hello Shandika', $helloService->hello('Shandika'));
    }
}
