<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $password
 * @property int $phone_number
 * @property string|null $email_verified_at
 * @property string|null $email
 */
class MerchantUser extends Authenticate {
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $table = 'merchant_users';

    public function merchants(): BelongsToMany {
        return $this->belongsToMany(Merchant::class, 'user_merchants', 'merchant_user_id', 'merchant_id');
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getPhoneNumber(): int {
        return $this->phone_number;
    }

    public function setPhoneNumber(int $phone_number): void {
        $this->phone_number = $phone_number;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }
}
