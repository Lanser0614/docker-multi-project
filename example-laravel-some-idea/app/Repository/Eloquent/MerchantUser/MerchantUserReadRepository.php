<?php

declare(strict_types=1);

namespace App\Repository\Eloquent\MerchantUser;

use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Read\BaseReadRepository;
use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Read\BaseReadRepositoryInterface;

class MerchantUserReadRepository extends BaseReadRepository implements MerchantUserReadRepositoryInterface {
    public function getByPhone(int $phone): BaseReadRepositoryInterface {
        $this->model->where('phone_number', '=', $phone);

        return $this;
    }
}
