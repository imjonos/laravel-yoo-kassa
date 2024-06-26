<?php

namespace Nos\Yookassa;

use Nos\Yookassa\Enums\Currency;
use Nos\Yookassa\Models\YookassaPayment;
use Nos\Yookassa\Services\PaymentService;
use YooKassa\Common\Exceptions\ApiConnectionException;
use YooKassa\Common\Exceptions\ApiException;
use YooKassa\Common\Exceptions\AuthorizeException;
use YooKassa\Common\Exceptions\BadApiRequestException;
use YooKassa\Common\Exceptions\ExtensionNotFoundException;
use YooKassa\Common\Exceptions\ForbiddenException;
use YooKassa\Common\Exceptions\InternalServerError;
use YooKassa\Common\Exceptions\NotFoundException;
use YooKassa\Common\Exceptions\ResponseProcessingException;
use YooKassa\Common\Exceptions\TooManyRequestsException;
use YooKassa\Common\Exceptions\UnauthorizedException;

final class Yookassa
{
    public function __construct(private readonly PaymentService $paymentService)
    {
    }

    /**
     * @throws NotFoundException
     * @throws ApiException
     * @throws ResponseProcessingException
     * @throws BadApiRequestException
     * @throws ExtensionNotFoundException
     * @throws AuthorizeException
     * @throws InternalServerError
     * @throws ForbiddenException
     * @throws TooManyRequestsException
     * @throws ApiConnectionException
     * @throws UnauthorizedException
     */
    public function createPayment(
        float $amount,
        string $description = '',
        string $email = '',
        Currency $currency = Currency::RUB,
        bool $capture = true
    ): YookassaPayment {
        return $this->paymentService->create($amount, $description, $email, $currency, $capture);
    }
}
