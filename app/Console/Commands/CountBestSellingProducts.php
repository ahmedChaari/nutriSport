<?php

namespace App\Console\Commands;

use App\Models\OrderProduct;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CountBestSellingProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'count:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count best Selling Product every 1min';

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
        OrderProduct::select(
            [DB::raw('count(product_id) as productCount'),
             DB::raw('(product_id) as product'),
            ])
                ->groupBy('product_id')
                ->get();
    }

}
