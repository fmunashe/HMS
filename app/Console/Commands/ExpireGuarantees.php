<?php

namespace App\Console\Commands;

use App\Guarantee;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireGuarantees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:guarantees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command expires guarantees that have lapsed their periods';

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
        $guarantees=Guarantee::query()->where('end_date','<',Carbon::now()->format('Y-m-d'))->where('active',true)->get();
        foreach($guarantees as $guarantee){
        $guarantee->active=false;
        $guarantee->save();
        }
        }
        catch(\Exception $ex){

        }
    }
}
