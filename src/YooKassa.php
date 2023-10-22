<?php

namespace Nos\YooKassa;

use Nos\YooKassa\Enums\Currency;
use Nos\YooKassa\Models\PaymentModel;
use Nos\YooKassa\Services\PaymentService;
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

class YooKassa
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
        Currency $currency = Currency::RUB,
        bool $capture = true
    ): PaymentModel {
        return $this->paymentService->create($amount, $description, $currency, $capture);
    }
}
