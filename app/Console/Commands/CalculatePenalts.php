<?php

namespace App\Console\Commands;

use App\Loan;
use App\LoanSchedule;
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
        $schedules=LoanSchedule::query()->where('end_date','<',Carbon::now())->where('status',false)->get();
        foreach ($schedules as $schedule){
            $loans=Loan::query()->where('loan_id',$schedule->loan_id)->first();
            $pena=$loans->applicable_penalt*$schedule->installment;
            $schedule->overdue+=$pena;
            $schedule->save();
        }

    }
}
