<?php

declare(strict_types=1);

namespace App\UseCases\Merchant\Merchant;

use App\DTO\Merchant\Merchant\UpdateMerchantDTO;
use App\Models\Merchant;
use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Read\BaseReadRepositoryInterface;
use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Write\BaseWriteRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UpdateMerchantUseCase {
    public function __construct(
        private readonly BaseWriteRepositoryInterface $baseWriteRepository,
        private readonly BaseReadRepositoryInterface $baseReadRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function perform(int $id, UpdateMerchantDTO $storeMerchantDTO): Model {
        $merchant = $this->baseReadRepository->setModel(Merchant::query())->find($id)->first();

        $this->checkEntityTask->run($merchant);

        $merchant = (new Merchant)->setName($storeMerchantDTO->getName())
            ->setLatitude($storeMerchantDTO->getLatitude())
            ->setLongitude($storeMerchantDTO->getLongitude());

        DB::transaction(function () use ($merchant) {
            $this->baseWriteRepository->save($merchant);
            $merchant->merchantUsers()->attach(auth()->user());
        });

        return $merchant;
    }
}
