<?php

namespace Nos\YooKassa\Interfaces\Repositories;

use Nos\BaseRepository\Interfaces\EloquentRepositoryInterface;

interface PaymentRepositoryInterface extends EloquentRepositoryInterface
{
    public function updateByUuid(string $id, array $data): bool;
}
