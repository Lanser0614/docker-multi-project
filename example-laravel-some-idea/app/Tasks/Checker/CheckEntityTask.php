<?php

namespace App\Tasks\Checker;

use App\Enums\ExceptionEnum\ExceptionEnum;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CheckEntityTask {
    public function run($model): void {
        if ($model === null) {
            throw new ModelNotFoundException(ExceptionEnum::ENTITY_NOT_FOUND->name, 500);
        }
    }
}
