<?php

namespace App\Console\Commands;

use App\Loan;
use App\Penalty;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalculatePenalts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:penalts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command calculates accrued penalts everyday at midnight';

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
        $penalts=Penalty::where('due_date','<',Carbon::now())->get();
        foreach($penalts as $penalt){
         $loans=Loan::where('loan_id',$penalt->loan_id)->first();
         $pena=$loans->applicable_penalt*$penalt->installment_fee;
         $penalt->penalty_fee=$penalt->penalty_fee+$pena;
         $loans->outstanding=$loans->outstanding+$pena;
         $loans->save();
         $penalt->save();
        }

    }
}
