<?php

namespace App\Models;

use App\Filters\BaseFilter\BaseFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;

/**
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 *
 * @method static Builder|self filter($request, $filters)
 */
class Merchant extends Model {
    public function getLatitude(): string {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): static {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): string {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): static {
        $this->longitude = $longitude;

        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): static {
        $this->name = $name;

        return $this;
    }

    use HasFactory;

    public function merchantUsers(): BelongsToMany {
        return $this->belongsToMany(MerchantUser::class, 'user_merchants_pivot', 'merchant_id', 'merchant_user_id');
    }

    public function scopeFilter($builder, Request $request, array $filters): Builder {
        return (new BaseFilter($builder, $request, $filters))->apply();
    }
}
