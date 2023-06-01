<?php

namespace App\Console\Commands;


use Carbon\Carbon;
use App\Models\ClosePage;
use App\Classes\FtpServers;
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
    protected $description = 'works reading from closePages models';
    protected $myftp;

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
        $pages = ClosePage::where('done', 0)->get();
        if (count($pages) > 0) {
            $now = Carbon::now()->format('Y-m-d H:i');
            foreach ($pages as $item) {
                $close_at = Carbon::parse($item->close_at)->format('Y-m-d H:i'); //->setTimezone('America/Los_Angeles');
                if (strtotime($close_at) <= strtotime($now)) {
                    $this->cerrar($item);
                }
            } //forEach 
        } // if there are pages to close

    } //handle

    private function cerrar($item){  
        $this->myftp = new FtpServers();
        $this->myftp->closePage($item);
        $this->myftp->close();
    }

} //class
