<?php

namespace App\Tools;

use Faker\Generator;
use Illuminate\Container\Container;

class Color
{
    public function generator()
    {
        return Container::getInstance()->make(Generator::class);
    }
    public function get()
    {
        return $this->generator()->hexColor;
    }
}
