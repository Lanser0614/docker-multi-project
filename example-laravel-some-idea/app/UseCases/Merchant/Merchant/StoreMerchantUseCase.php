<?php

declare(strict_types=1);

namespace App\UseCases\Merchant\Merchant;

use App\DTO\Merchant\Merchant\StoreMerchantDTO;
use App\Models\Merchant;
use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Write\BaseWriteRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StoreMerchantUseCase {
    public function __construct(
        private readonly BaseWriteRepositoryInterface $baseWriteRepository
    ) {
    }

    public function perform(StoreMerchantDTO $storeMerchantDTO): Model {
        $merchant = (new Merchant)->setName($storeMerchantDTO->getName())
            ->setLatitude($storeMerchantDTO->getLatitude())
            ->setLongitude($storeMerchantDTO->getLongitude());

        DB::transaction(function () use ($merchant) {
            $merchant = $this->baseWriteRepository->save($merchant);
            $merchant->merchantUsers()->attach(auth()->user());
        });

        return $merchant;
    }
}
