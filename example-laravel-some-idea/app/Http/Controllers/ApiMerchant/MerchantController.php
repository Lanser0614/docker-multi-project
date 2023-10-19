<?php

declare(strict_types=1);

namespace App\Http\Controllers\ApiMerchant;

use App\DTO\Merchant\Merchant\StoreMerchantDTO;
use App\DTO\Merchant\Merchant\UpdateMerchantDTO;
use App\Enums\Message\MessageEnum;
use App\Filters\EloquentFilter\Merchant\MerchantByUserIdFilter;
use App\Http\Controllers\BaseController\BaseApiController;
use App\Http\Requests\Merchant\Merchant\MerchantStoreRequest;
use App\Http\Requests\Merchant\Merchant\MerchantUpdateRequest;
use App\Models\Merchant;
use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Read\BaseReadRepositoryInterface;
use App\UseCases\Merchant\Merchant\DeleteMerchantUseCase;
use App\UseCases\Merchant\Merchant\StoreMerchantUseCase;
use App\UseCases\Merchant\Merchant\UpdateMerchantUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MerchantController extends BaseApiController {
    public function __construct(
        private readonly BaseReadRepositoryInterface $baseReadRepository,
    ) {
    }

    public function index(Request $request): JsonResponse {
        $merchants = Merchant::query()
            ->filter(
                $request,
                [
                    MerchantByUserIdFilter::class,
                ]
            )
            ->latest('id')->paginate($request->input('perPage') ?? 15, ['*'], $request->input('page') ?? 1);

        return new JsonResponse($this->responseWithPagination($merchants));
    }

    public function store(MerchantStoreRequest $request, StoreMerchantUseCase $useCase): JsonResponse {
        $useCase->perform(StoreMerchantDTO::fromArray($request->all()));

        return new JsonResponse($this->responseSuccess(MessageEnum::SUCCESS->value));
    }

    public function update(int $id, MerchantUpdateRequest $request, UpdateMerchantUseCase $useCase): JsonResponse {
        $useCase->perform($id, UpdateMerchantDTO::fromArray($request->all()));

        return new JsonResponse($this->responseSuccess(MessageEnum::SUCCESS->value));
    }

    public function show(int $id): JsonResponse {
        $merchant = $this->baseReadRepository->setModel(Merchant::query())->find($id)->first();

        return new JsonResponse($this->responseOneItem($merchant));
    }

    public function delete(int $id, DeleteMerchantUseCase $useCase): JsonResponse {
        $useCase->perform($id);

        return new JsonResponse($this->responseOnDelete());
    }
}
