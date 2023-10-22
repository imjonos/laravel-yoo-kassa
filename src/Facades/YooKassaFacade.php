<?php

namespace Nos\YooKassa\Facades;

use Illuminate\Support\Facades\Facade;

class YooKassaFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'YooKassa';
    }
}
