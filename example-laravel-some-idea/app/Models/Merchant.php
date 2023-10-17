<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $name
 * @property string $coordinate
 */
class Merchant extends Model {
    use HasFactory;


    /**
     * @return BelongsToMany
     */
    public function merchants(): BelongsToMany {
        return $this->belongsToMany(MerchantUser::class, 'user_merchants', 'merchant_id', 'merchant_user_id');
    }
}
