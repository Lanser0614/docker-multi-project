<?php

declare(strict_types=1);

namespace App\DTO\Merchant\MerchantUser;

class MerchantUserLoginDTO {
    public function __construct(
        private readonly int $phone,
        private readonly string $password
    ) {
    }

    public function getPhone(): int {
        return $this->phone;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public static function frommArray(array $data): static {
        return new self(
            phone: $data['phone'],
            password: $data['password'],
        );
    }
}
