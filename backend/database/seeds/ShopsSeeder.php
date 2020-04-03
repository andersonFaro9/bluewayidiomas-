<?php

use App\Domains\Gateway\Shop\ShopRepository;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

/**
 * Class ShopsSeeder
 */
class ShopsSeeder extends Seeder
{
    /**
     */
    public function run()
    {
        // use Illuminate\Support\Facades\DB;
        // DB::table('shops')->delete();
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            $secret = uniqid();
            ShopRepository::instance()->create([
                'name' => $faker->company,
                'url' => $faker->url,
                'clientId' => "CI-{$secret}",
                'clientSecret' => "CS-{$secret}",
            ]);
        }
    }
}
