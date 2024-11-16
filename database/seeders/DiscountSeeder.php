<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discounts = [
            [
                'code' => 'DISCOUNT10',
                'number' => 10,
            ],
            [
                'code' => 'DISCOUNT20',
                'number' => 20,
            ],
            [
                'code' => 'DISCOUNT30',
                'number' => 30,
            ],
        ];

        foreach ($discounts as $discount) {
            Discount::create($discount);
        }
    }
}
