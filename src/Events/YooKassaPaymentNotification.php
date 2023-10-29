<?php

namespace Nos\Yookassa\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Nos\Yookassa\Models\YookassaPayment;

final class YooKassaPaymentNotification
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public YookassaPayment $payment
    ) {
    }
}
