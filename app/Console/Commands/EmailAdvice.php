<?php

namespace App\Console\Commands;

use App\Customer;
use App\Loan;
use App\Mail\AdviceMail;
use App\Penalty;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmailAdvice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:advice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Advice clients five days before applying penalty fees to their loans';

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
        $penalts=Penalty::where('due_date','<=',Carbon::now()->addDays(5))->get();
        foreach($penalts as $penalt){
            $loan=Loan::where('loan_id',$penalt->loan_id)->first();
            $customer = Customer::where('national_id',$loan->client_id)->first();
            Mail::to($customer->email)->send(new AdviceMail($customer));
        }
    }
}
