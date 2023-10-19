<?php

namespace Database\Seeders;

use App\Models\Merchant;
use App\Models\MerchantUser;
use Faker\Factory;
use Illuminate\Database\Seeder;

class MerchantSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = Factory::create();

        for ($i = 0; $i <= 1000; $i++) {
            $merchant = (new Merchant)
                ->setName($faker->name)
                ->setLongitude((string) $faker->longitude)
                ->setLatitude((string) $faker->latitude);
            $merchant->save();
            $user = MerchantUser::query()->inRandomOrder()->first();
            $merchant->merchantUsers()->attach($user);
        }
    }
}
