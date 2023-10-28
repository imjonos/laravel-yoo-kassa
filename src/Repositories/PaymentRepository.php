<?php

namespace Nos\Yookassa\Repositories;

use Nos\BaseRepository\EloquentRepository;
use Nos\Yookassa\Interfaces\Repositories\PaymentRepositoryInterface;
use Nos\Yookassa\Models\YookassaPayment;

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

    public function findByUuid(string $id): ?YookassaPayment
    {
        return $this->getModel()
            ->find($id);
    }
}
