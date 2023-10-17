<?php

namespace App\Trait;

trait ParseDataTrait {
    private static function parseInt(mixed $value): void {
        if (! is_int($value)) {
            throw new \InvalidArgumentException('Parse error');
        }
    }

    private static function parseNullableInt(mixed $value): void {
        if (! is_null($value)) {
            self::parseInt($value);
        }
    }

    private static function parseString(mixed $value): void {
        if (! is_string($value)) {
            throw new \InvalidArgumentException('Parse error');
        }
    }

    private static function parseNullableString(mixed $value): void {
        if (! is_null($value)) {
            self::parseString($value);
        }
    }
}
