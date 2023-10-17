<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMerchants extends Model {
    use HasFactory;

    protected $table = 'user_merchants_pivot';
}
