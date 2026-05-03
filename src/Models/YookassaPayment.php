<?php

declare(strict_types=1);

namespace Nos\Yookassa\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

final class YookassaPayment extends Model
{
    use HasUuids;

    protected $fillable = [
        'id',
        'confirmation_url',
        'status',
        'amount',
        'currency',
        'description',
        'metadata',
        'recipient_account_id',
        'recipient_gateway_id',
        'refundable',
        'test'
    ];
}
