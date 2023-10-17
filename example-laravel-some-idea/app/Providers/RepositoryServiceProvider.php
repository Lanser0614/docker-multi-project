<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Read\BaseReadRepository;
use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Read\BaseReadRepositoryInterface;
use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Write\BaseWriteRepository;
use App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Write\BaseWriteRepositoryInterface;
use App\Repository\Eloquent\MerchantUser\MerchantUserReadRepository;
use App\Repository\Eloquent\MerchantUser\MerchantUserReadRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
    /**
     * Bootstrap the application services.
     */
    public function register(): void {
        $this->app->bind(BaseWriteRepositoryInterface::class, BaseWriteRepository::class);
        $this->app->bind(BaseReadRepositoryInterface::class, BaseReadRepository::class);
        $this->app->bind(MerchantUserReadRepositoryInterface::class, MerchantUserReadRepository::class);
    }
}
