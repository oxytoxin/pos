<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(10000)->create()->each(function ($p) {
            $p->image()->create([
                'url' => 'https://picsum.photos/200'
            ]);
        });
    }
}
