<?php

declare(strict_types=1);

namespace App\Repository\Eloquent\MerchantUser;

use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Read\BaseReadRepositoryInterface;

interface MerchantUserReadRepositoryInterface extends BaseReadRepositoryInterface {
    public function getByPhone(int $phone): BaseReadRepositoryInterface;
}
