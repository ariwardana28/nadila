<?php

namespace App\Console\Commands;

use App\model\Bayar;
use Carbon\Carbon;
use Illuminate\Console\Command;

class updateCancelOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:updateCancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel Orderan in 3 days';

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
        $bayar = Bayar::where('created_at',Carbon::now()->subDays(3))->get()->delete();
    }
}
