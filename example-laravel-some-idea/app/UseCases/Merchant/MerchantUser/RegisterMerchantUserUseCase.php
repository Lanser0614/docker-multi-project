<?php

declare(strict_types=1);

namespace App\UseCases\Merchant\MerchantUser;

use App\DTO\Merchant\MerchantUser\MerchantUserDTO;
use App\Models\MerchantUser;
use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Write\BaseWriteRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class RegisterMerchantUserUseCase {
    public function __construct(
        private readonly BaseWriteRepositoryInterface $baseWriteRepository
    ) {
    }

    public function perform(MerchantUserDTO $DTO) {
        $merchantUser = new MerchantUser;
        $merchantUser->setName($DTO->getName());
        $merchantUser->setPhoneNumber($DTO->getPhoneNumber());
        $merchantUser->setEmail($DTO->getEmail());
        $merchantUser->setPassword(Hash::make($DTO->getPassword()));
        $this->baseWriteRepository->save($merchantUser);
    }
}
