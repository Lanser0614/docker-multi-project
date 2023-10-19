<?php

namespace App\Filters\Interface;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface {
    public function filter(Builder $builder, mixed $value): Builder;

    public function getBindingName();
}
