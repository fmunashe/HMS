<?php

namespace App\Console\Commands;

use App\Customer;
use App\Loan;
use App\LoanSchedule;
use App\Notifications\LoanAdvice;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Notifications\Notifiable;

class EmailAdvice extends Command
{
    use Notifiable;
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
        $date=Carbon::now()->addDays(5)->format('Y-m-d');
        $schedules=LoanSchedule::query()->where('end_date','<=',$date)->where('status',false)->get();
        foreach ($schedules as $schedule){
            $loan=Loan::query()->where('loan_id',$schedule->loan_id)->first();
            $customer = Customer::query()->where('national_id',$loan->client_id)->first();
            $cust=new Customer();
            $cust->email=$customer->email;
            $cust->notify(new LoanAdvice($customer,$schedule));
        }
    }
}
