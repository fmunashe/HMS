<?php

namespace App\Console\Commands;

use App\Loan;
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
        $penalts=Penalty::where('remaining_installments',0)->get();
        foreach($penalts as $penalt){
            $loan=Loan::where('loan_id',$penalt->loan_id)->first();
            $loan->status=107;
            $loan->save();
            $penalt->delete();
        }
    }
}
