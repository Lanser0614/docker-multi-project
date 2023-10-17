<?php

namespace App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Write;

use Illuminate\Database\Eloquent\Model;

interface BaseWriteRepositoryInterface {
    public function save(Model $data): Model;

    public function delete(Model $data): bool|int|null;
}
