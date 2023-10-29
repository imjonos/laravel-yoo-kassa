<?php

namespace Nos\Yookassa\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Nos\Yookassa\Enums\PaymentStatus;
use Nos\Yookassa\Events\YooKassaPaymentNotification;
use Nos\Yookassa\Http\Requests\IndexRequest;
use Nos\Yookassa\Services\PaymentService;
use YooKassa\Model\Notification\NotificationCanceled;
use YooKassa\Model\Notification\NotificationEventType;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;

final class NotificationController extends Controller
{
    public function __construct(private readonly PaymentService $paymentService)
    {
    }

    public function index(IndexRequest $request): JsonResponse
    {
        $requestBody = $request->all();
        if (($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)) {
            $notification = new NotificationSucceeded($requestBody);
        } elseif ($requestBody['event'] === NotificationEventType::PAYMENT_WAITING_FOR_CAPTURE) {
            $notification = new NotificationWaitingForCapture($requestBody);
        } else {
            $notification = new NotificationCanceled($requestBody);
        }

        $payment = $notification->getObject();
        $status = PaymentStatus::tryFrom($payment->getStatus());
        $this->paymentService->setStatus($payment->getId(), $status);
        $yookassaPayment = $this->paymentService->find($payment->getId());
        YooKassaPaymentNotification::dispatch($yookassaPayment);

        return response()->json();
    }
}
