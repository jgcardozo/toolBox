<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CouponAvailable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupon:available';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if coupon must be available evaluating fields actived, deleted and dateTime:available_until';

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
        return 0;
    }
}
