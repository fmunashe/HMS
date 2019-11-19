<?php

use App\Branch;
use App\Currency;
use App\Repayment;
use App\Status;
use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Branch::create([
            'branch_code' => '040',
            'branch_name' => 'Nelson Mandela',
        ]);
        Currency::create([
            'currency_code' => '840',
            'currency_name' => 'USD',
        ]);
        $frequencies=[
            ['frequency_number'=>'1','frequency_name'=>'Annually'],
            ['frequency_number'=>'2','frequency_name'=>'Semi Annually'],
            ['frequency_number'=>'4','frequency_name'=>'Quarterly'],
            ['frequency_number'=>'12','frequency_name'=>'Monthly']
        ];
        foreach ($frequencies as $frequency) {
            Repayment::create($frequency);
        }
        $statuses = [
            ['status_code'=>'100','status_name' => 'Allocated'],
            ['status_code'=>'101','status_name' => 'Reserved'],
            ['status_code'=>'102','status_name' => 'Not Allocated'],
            ['status_code'=>'103','status_name' => 'Awaiting Authorisation'],
            ['status_code'=>'104','status_name' => 'In Funding'],
            ['status_code'=>'105','status_name' => 'Current'],
            ['status_code'=>'106','status_name' => 'Rejected'],
            ['status_code'=>'107','status_name' => 'Fully Paid'],
            ['status_code'=>'108','status_name' => 'Anomalies'],
        ];
        foreach ($statuses as $status) {
            Status::create($status);
        }

    }
}
