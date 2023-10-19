<?php

declare(strict_types=1);

namespace App\UseCases\Merchant\Merchant;

use App\Models\Merchant;
use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Read\BaseReadRepositoryInterface;
use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Write\BaseWriteRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use Illuminate\Support\Facades\DB;

class DeleteMerchantUseCase {
    public function __construct(
        private readonly BaseWriteRepositoryInterface $baseWriteRepository,
        private readonly BaseReadRepositoryInterface $baseReadRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function perform(int $id): void {
        $merchant = $this->baseReadRepository->setModel(Merchant::query())->find($id)->first();

        $this->checkEntityTask->run($merchant);

        DB::transaction(function () use ($merchant) {
            $merchant->merchantUsers()->detach(auth()->user());
            $this->baseWriteRepository->delete($merchant);
        });
    }
}
