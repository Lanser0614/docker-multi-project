<?php

namespace App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Read;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BaseReadRepositoryInterface {
    public function setModel(Builder $model): BaseReadRepositoryInterface;

    public function all(array $relations = []): BaseReadRepositoryInterface;

    public function find(int $id, array $relations = []): BaseReadRepositoryInterface;

    public function get(): Collection;

    public function first(): ?Model;

    public function paginate(int $perPage = 15, int $page = 1): LengthAwarePaginator;
}
