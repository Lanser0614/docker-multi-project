<?php

declare(strict_types=1);

namespace App\UseCases\Merchant\MerchantUser;

use App\DTO\Merchant\MerchantUser\MerchantUserLoginDTO;
use App\Exceptions\BusinessException;
use App\Models\MerchantUser;
use App\Repository\Eloquent\MerchantUser\MerchantUserReadRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;
use Illuminate\Support\Facades\Hash;

class MerchantUserLoginUseCase {
    public function __construct(
        private readonly MerchantUserReadRepositoryInterface $merchantUserReadRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    /**
     * @throws BusinessException
     */
    public function perform(MerchantUserLoginDTO $dto): mixed {
        $user = $this->merchantUserReadRepository->setModel(MerchantUser::query())->getByPhone($dto->getPhone())->first();

        $this->checkEntityTask->run($user);

        if (Hash::check($dto->getPassword(), $user->password)) {
            $token = $user->createToken('test.uz')->plainTextToken;
        } else {
            throw new BusinessException('Wrong password');
        }

        return $token;
    }
}
