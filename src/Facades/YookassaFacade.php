<?php

namespace Nos\Yookassa\Facades;

use Illuminate\Support\Facades\Facade;
use Nos\Yookassa\Enums\Currency;
use Nos\Yookassa\Models\YookassaPayment;

/**
 * @method static YookassaPayment CreatePayment(float $amount, string $description = '', Currency $currency = Currency::RUB, bool $capture = true)
 */
final class YookassaFacade extends Facade
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
