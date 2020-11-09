<?php

namespace App\Console\Commands;

use App\model\Penjualan;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class updateExpiredOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Order Expired';

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
        try{
            DB::beginTransaction();
            //-------------------------------------------------------------------------
            $date = Carbon::now()->subDays(3);
            \Log::info("Order Update: ".$date);
            $penjualan = Penjualan::whereDate('created_at',Carbon::now()->subDays(3))
                ->orWhere('status',null)->get();
            \Log::info("Order Update: ".$penjualan);
            foreach ($penjualan as $item){
                $item->status = "Dibatalkan";
                $item->update(['status'=>'Dibatalkan']);
                $item->save();
            }
            //-------------------------------------------------------------------------
            DB::commit();
            \Log::info("Order Update: ".$penjualan);
        }catch (\Exception $e){
            DB::rollBack();
            \Log::info("Order Update Failed: ");
        }

    }
}
