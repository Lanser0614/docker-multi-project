<?php

declare(strict_types=1);

namespace App\Http\Controllers\ApiMerchant;

use App\DTO\Merchant\MerchantUser\MerchantUserDTO;
use App\DTO\Merchant\MerchantUser\MerchantUserLoginDTO;
use App\Exceptions\BusinessException;
use App\Http\Controllers\BaseController\BaseApiController;
use App\Http\Requests\Merchant\MerchantUser\LoginRequest;
use App\Http\Requests\Merchant\MerchantUser\MerchantUserRegisterRequest;
use App\UseCases\Merchant\MerchantUser\MerchantUserLoginUseCase;
use App\UseCases\Merchant\MerchantUser\RegisterMerchantUserUseCase;
use Illuminate\Http\JsonResponse;

class MerchantController extends BaseApiController {
    public function store()
    {

    }
}
