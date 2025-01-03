<?php

namespace Database\Seeders;

use App\Models\StockData;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StockData::create(['item_code' => '0001', 'item_name' => 'Dummy', 'quantity' => 10, 'location' => 'surat', 'store_id' => 1, 'in_stock_date' => now()]);
    }
}
