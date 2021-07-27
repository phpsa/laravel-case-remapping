<?php

namespace Phpsa\LaravelCaseRemapping;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Phpsa\LaravelCaseRemapping\LaravelCaseRemapping
 */
class LaravelCaseRemappingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-case-remapping';
    }
}
