<?php

namespace Nos\Yookassa\Interfaces\Repositories;

use Nos\BaseRepository\Interfaces\EloquentRepositoryInterface;
use Nos\YooKassa\Models\YookassaPayment;

interface PaymentRepositoryInterface extends EloquentRepositoryInterface
{
    public function updateByUuid(string $id, array $data): bool;

    public function findByUuid(string $id): ?YookassaPayment;
}
