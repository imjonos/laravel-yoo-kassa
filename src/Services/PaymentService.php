<?php

namespace Nos\YooKassa\Services;

use Nos\YooKassa\Enums\Currency;
use Nos\YooKassa\Enums\PaymentStatus;
use Nos\YooKassa\Interfaces\Repositories\PaymentRepositoryInterface;
use Nos\YooKassa\Models\PaymentModel;
use YooKassa\Client;
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

/**
 * @method PaymentRepositoryInterface getRepository()
 */
final class PaymentService
{
    public function __construct(private Client $client, private PaymentRepositoryInterface $paymentRepository)
    {
    }

    /**
     * @throws NotFoundException
     * @throws ResponseProcessingException
     * @throws ApiException
     * @throws ExtensionNotFoundException
     * @throws BadApiRequestException
     * @throws AuthorizeException
     * @throws InternalServerError
     * @throws ForbiddenException
     * @throws TooManyRequestsException
     * @throws ApiConnectionException
     * @throws UnauthorizedException
     */
    public function create(
        float $amount,
        string $description = '',
        Currency $currency = Currency::RUB,
        bool $capture = true
    ): PaymentModel {
        $payment = $this->client->createPayment(
            array(
                'amount' => array(
                    'value' => $amount,
                    'currency' => $currency->name,
                ),
                'confirmation' => array(
                    'type' => 'redirect',
                    'return_url' => config('yookassa.return_url'),
                ),
                'capture' => $capture,
                'description' => $description,
            ),
            uniqid('', true)
        );

        return $this->paymentRepository->create([
            'id' => $payment->getId(),
            'status' => $payment->getStatus(),
            'amount' => $payment->getAmount()->getValue(),
            'currency' => $payment->getAmount()->getCurrency(),
            'description' => $payment->getDescription(),
            'metadata' => $payment->getMetadata()->toArray(),
            'recipient_account_id' => $payment->getRecipient()->getAccountId(),
            'recipient_gateway_id' => $payment->getRecipient()->getGatewayId(),
            'refundable' => $payment->getRefundable(),
            'test' => $payment->getTest()
        ]);
    }

    public function setStatus(string $id, PaymentStatus $status): bool
    {
        return $this->paymentRepository->updateByUuid($id, [
            'status' => $status->value
        ]);
    }
}
