<?php

declare(strict_types=1);

namespace Nos\Yookassa\Facades;

use Illuminate\Support\Facades\Facade;
use Nos\Yookassa\Enums\Currency;
use Nos\Yookassa\Models\YookassaPayment;

/**
 * @method static YookassaPayment createPayment(float $amount, string $description = '', string $email = '', Currency $currency = Currency::RUB, bool $capture = true)
 */
final class YookassaFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Yookassa';
    }
}
