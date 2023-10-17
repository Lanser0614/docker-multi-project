<?php

declare(strict_types=1);

namespace App\DTO\Merchant\MerchantUser;

class MerchantUserDTO {
    public function __construct(
        private readonly string $name,
        private readonly string $password,
        private readonly int $phone_number,
        private readonly ?string $email_verified_at,
        private readonly ?string $email,
    ) {
    }

    public static function fromArray(array $data): static {
        return new static(
            name: $data['name'],
            password: $data['password'],
            phone_number: $data['phone_number'],
            email_verified_at: $data['email_verified_at'] ?? null,
            email: $data['email'] ?? null,
        );
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getPhoneNumber(): int {
        return $this->phone_number;
    }

    public function getEmailVerifiedAt(): ?string {
        return $this->email_verified_at;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function getName(): string {
        return $this->name;
    }
}
