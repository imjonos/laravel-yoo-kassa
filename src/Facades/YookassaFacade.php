<?php

namespace Nos\Yookassa\Facades;

use Illuminate\Support\Facades\Facade;
use Nos\YooKassa\Enums\Currency;
use Nos\YooKassa\Models\YookassaPayment;

/**
 * @method static YookassaPayment CreatePayment(float $amount, string $description = '', Currency $currency = Currency::RUB, bool $capture = true)
 */
class YookassaFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'Yookassa';
    }
}
