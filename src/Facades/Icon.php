<?php

namespace Hebinet\SvgIcons\Facades;

use Illuminate\Support\Facades\Facade;

class Icon extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'icon';
    }
}