<?php

use App\Services\HelloService;

class HelloServiceIndonesia implements HelloService {
    public function hello(string $name): string{
        return "Hallo $name";
    }
}