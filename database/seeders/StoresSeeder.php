<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storesArray = [
            ['name' => 'Store 1'],
            ['name' => 'Store 2'],
            ['name' => 'Store 3'],
            ['name' => 'Store 4'],
            ['name' => 'Store 5'],
        ];

        foreach ($storesArray as $key => $store) {
            Store::updateOrCreate(['store_name' => $store['name']], ['store_name' => $store['name']]);
        }
    }
}
