<?php

declare(strict_types=1);

namespace App\DTO\Merchant\Merchant;

class UpdateMerchantDTO {
    public function __construct(
        private readonly string $name,
        private readonly string $latitude,
        private readonly string $longitude,
    ) {
    }

    public function getLatitude(): string {
        return $this->latitude;
    }

    public function getLongitude(): string {
        return $this->longitude;
    }

    public function getName(): string {
        return $this->name;
    }

    public static function fromArray(array $data): static {
        return new static(
            name: $data['name'],
            latitude: $data['latitude'],
            longitude: $data['longitude']
        );
    }
}
