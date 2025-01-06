<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StockData;

class UpdateStockStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocks:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update stock entries status to "in-stock" when the in-stock date is today';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();

        $updatedRows = StockData::whereDate('in_stock_date', $today)
                            ->where('status', '!=', '1') // 1 = in-stock, 0 = out-stock;
                            ->update(['status' => '1']);

        $this->info("Updated stock entries to 'in-stock'.");
    }
}
