<?php


class Test {
    public function index(): void
    {
        echo "TEST";
    }
}

$class = [
    Test::class
];

$a = new $class[0];

$a->index();


