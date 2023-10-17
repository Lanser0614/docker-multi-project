<?php

declare(strict_types=1);

namespace App\Repository\Eloquent\MerchantUser;

use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Read\BaseReadRepository;

class MerchantUserReadRepository extends BaseReadRepository implements MerchantUserReadRepositoryInterface {
    public function getByPhone(int $phone): MerchantUserReadRepositoryInterface {
        $this->model->where('phone_number', '=', $phone);

        return $this;
    }
}
