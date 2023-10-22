<?php

namespace Nos\YooKassa\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Nos\YooKassa\Enums\PaymentStatus;
use Nos\YooKassa\Http\Requests\IndexRequest;
use Nos\YooKassa\Services\PaymentService;
use YooKassa\Model\Notification\NotificationCanceled;
use YooKassa\Model\Notification\NotificationEventType;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;

class NotificationController extends Controller
{
    public function __construct(private readonly PaymentService $service)
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
        $this->service->setStatus($payment->getId(), $status);

        return response()->json();
    }
}
