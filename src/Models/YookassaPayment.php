<?php

namespace Nos\YooKassa\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $confirmation_url
 * @property string $status
 * @property float $amount
 * @property string $currency
 * @property string $description
 * @property array $metadata
 * @property int $recipient_account_id
 * @property int $recipient_gateway_id
 * @property bool $refundable
 * @property bool $test
 */
final class YookassaPayment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
