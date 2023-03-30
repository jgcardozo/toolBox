<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PageClose extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'page:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this Command is to close pages using !isset[] in index file';

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
        $texto = date('Ymd-H:i:s');
        return 0;
    }
}
