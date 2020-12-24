<?php

namespace App\Console\Commands;

use App\model\Penjualan;
use Illuminate\Console\Command;

class testingCheckOrderCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing:orderCount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing to count order in database';

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
     * @return mixed
     */
    public function handle()
    {
        $penjualan = Penjualan::count();
        \Log::info("Order count by minute: ".$penjualan);

        $this->info('CountOrder:Cron Cummand Run successfully!');
    }
}
