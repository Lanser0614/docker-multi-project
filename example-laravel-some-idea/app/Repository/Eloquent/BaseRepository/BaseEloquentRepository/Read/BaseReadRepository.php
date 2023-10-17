<?php

declare(strict_types=1);

namespace App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Read;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BaseReadRepository implements BaseReadRepositoryInterface {
    protected Builder $model;

    public function setModel(Builder $model): BaseReadRepositoryInterface {
        $this->model = $model;

        return $this;
    }

    public function all(array $relations = []): BaseReadRepositoryInterface {
        $this->model->with($relations);

        return $this;
    }

    public function show(int $id, array $relations = []): BaseReadRepositoryInterface {
        $this->model->with($relations)->where('id', $id);

        return $this;
    }

    public function get(): Collection {
        return $this->model->get();
    }

    public function first(): ?Model {
        return $this->model->first();
    }

    public function paginate(int $perPage = 15, int $page = 1): LengthAwarePaginator {
        return $this->model->paginate($perPage, ['*'], $page);
    }
}
