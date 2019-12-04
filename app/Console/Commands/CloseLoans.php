<?php

namespace App\Console\Commands;

use App\Loan;
use App\LoanSchedule;
use App\Penalty;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CloseLoans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'close:loans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This job closes all loans that have matured';

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
        //
        $loans =Loan::query()->where('outstanding','<=',0)->get();
        foreach ($loans as $loan){
        $schedules=LoanSchedule::query()->where('loan_id',$loan->loan_id)->get();
        foreach ($schedules as $schedule){
          $schedule->overdue=0;
          $schedule->status=true;
          $schedule->save();
        }
         $loan->status=107;
         $loan->save();
        }
    }
}
