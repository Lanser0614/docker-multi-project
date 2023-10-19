<?php

declare(strict_types=1);

namespace App\Filters\EloquentFilter\Merchant;

use App\Filters\Interface\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class MerchantByUserIdFilter implements FilterInterface {
    public function filter(Builder $builder, mixed $value): Builder {
        return $builder->whereHas('merchantUsers', function (Builder $query) use ($value) {
          $query->where('merchant_user_id', $value);
        });
    }

    public function getBindingName(): string {
        return 'merchant_user_id';
    }
}
