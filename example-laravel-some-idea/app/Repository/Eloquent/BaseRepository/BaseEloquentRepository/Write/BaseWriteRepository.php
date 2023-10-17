<?php

declare(strict_types=1);

namespace App\Repository\Eloquent\BaseRepository\BaseEloquentRepository\Write;

use Illuminate\Database\Eloquent\Model;

class BaseWriteRepository implements BaseWriteRepositoryInterface {
    public function save(Model $data): Model {
        $data->save();

        return $data;
    }

    public function delete(Model $data): bool|int|null {
        return $data->delete();
    }
}
