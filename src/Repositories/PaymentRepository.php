<?php

namespace Nos\YooKassa\Repositories;

use Nos\BaseRepository\EloquentRepository;
use Nos\YooKassa\Interfaces\Repositories\PaymentRepositoryInterface;
use Nos\YooKassa\Models\YookassaPayment;

/**
 * @method YookassaPayment getModel()
 */
final class PaymentRepository extends EloquentRepository implements PaymentRepositoryInterface
{
    protected string $class = YookassaPayment::class;

    public function updateByUuid(string $id, array $data): bool
    {
        return $this->getModel()
            ->findOrFail($id)
            ->update($data);
    }
}
