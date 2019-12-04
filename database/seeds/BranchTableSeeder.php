<?php

use App\Branch;
use App\Currency;
use App\Facility;
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
        $branches=[
            ['branch_code'=>'ZW0010001','branch_name'=>'Head Office'],
            ['branch_code'=>'ZW0010002','branch_name'=>'Bindura'],
            ['branch_code'=>'ZW0010003','branch_name'=>'Binga'],
            ['branch_code'=>'ZW0010007','branch_name'=>'Checheche'],
            ['branch_code'=>'ZW0010008','branch_name'=>'Chegutu'],
            ['branch_code'=>'ZW0010009','branch_name'=>'Chibuwe'],
            ['branch_code'=>'ZW0010010','branch_name'=>'Chinhoyi'],
            ['branch_code'=>'ZW0010011','branch_name'=>'Chipinge'],
            ['branch_code'=>'ZW0010012','branch_name'=>'Chiredzi'],
            ['branch_code'=>'ZW0010015','branch_name'=>'Filabusi'],
            ['branch_code'=>'ZW0010016','branch_name'=>'Gokwe'],
            ['branch_code'=>'ZW0010017','branch_name'=>'Guruve'],
            ['branch_code'=>'ZW0010018','branch_name'=>'Gutu'],
            ['branch_code'=>'ZW0010019','branch_name'=>'Gwanda'],
            ['branch_code'=>'ZW0010020','branch_name'=>'Gweru'],
            ['branch_code'=>'ZW0010021','branch_name'=>'Hwange'],
            ['branch_code'=>'ZW0010022','branch_name'=>'Inala House Bulawayo'],
            ['branch_code'=>'ZW0010023','branch_name'=>'Jason Moyo Avenue Bulawayo'],
            ['branch_code'=>'ZW0010024','branch_name'=>'Jerera'],
            ['branch_code'=>'ZW0010025','branch_name'=>'Karoi'],
            ['branch_code'=>'ZW0010026','branch_name'=>'Kotwa'],
            ['branch_code'=>'ZW0010027','branch_name'=>'Lupane'],
            ['branch_code'=>'ZW0010028','branch_name'=>'Magunje'],
            ['branch_code'=>'ZW0010029','branch_name'=>'Maphisa'],
            ['branch_code'=>'ZW0010030','branch_name'=>'Marondera'],
            ['branch_code'=>'ZW0010031','branch_name'=>'Masvingo'],
            ['branch_code'=>'ZW0010032','branch_name'=>'Mataga'],
            ['branch_code'=>'ZW0010033','branch_name'=>'Mt Darwin'],
            ['branch_code'=>'ZW0010034','branch_name'=>'Mubaira'],
            ['branch_code'=>'ZW0010035','branch_name'=>'Murambinda'],
            ['branch_code'=>'ZW0010036','branch_name'=>'Murehwa'],
            ['branch_code'=>'ZW0010037','branch_name'=>'Mutare'],
            ['branch_code'=>'ZW0010038','branch_name'=>'Mutoko'],
            ['branch_code'=>'ZW0010039','branch_name'=>'Mvurwi'],
            ['branch_code'=>'ZW0010040','branch_name'=>'Nelson Mandela'],
            ['branch_code'=>'ZW0010041','branch_name'=>'Norton'],
            ['branch_code'=>'ZW0010042','branch_name'=>'Nyanga'],
            ['branch_code'=>'ZW0010043','branch_name'=>'Nyika'],
            ['branch_code'=>'ZW0010044','branch_name'=>'R.G.Mugabe Harare'],
            ['branch_code'=>'ZW0010045','branch_name'=>'Rusape'],
            ['branch_code'=>'ZW0010046','branch_name'=>'Rushinga'],
            ['branch_code'=>'ZW0010047','branch_name'=>'Sanyati'],
            ['branch_code'=>'ZW0010049','branch_name'=>'Wedza'],
            ['branch_code'=>'ZW0010050','branch_name'=>'Westgate'],
            ['branch_code'=>'ZW0010051','branch_name'=>'York House Bulawayo'],
            ['branch_code'=>'ZW0010052','branch_name'=>'Zvishavane'],
            ['branch_code'=>'ZW0010054','branch_name'=>'Chivi'],
            ['branch_code'=>'ZW0010300','branch_name'=>'Microfinance HQ'],
            ['branch_code'=>'ZW0010309','branch_name'=>'Microfinance Chibuwe'],
            ['branch_code'=>'ZW0010312','branch_name'=>'Microfinance Chiredzi'],
            ['branch_code'=>'ZW0010315','branch_name'=>'Microfinance Filabusi'],
            ['branch_code'=>'ZW0010316','branch_name'=>'Microfinance Gokwe'],
            ['branch_code'=>'ZW0010317','branch_name'=>'Microfinance Guruve'],
            ['branch_code'=>'ZW0010319','branch_name'=>'Microfinance Gwanda'],
            ['branch_code'=>'ZW0010329','branch_name'=>'Microfinance Maphisa'],
            ['branch_code'=>'ZW0010338','branch_name'=>'Microfinance Mutoko'],
            ['branch_code'=>'ZW0010344','branch_name'=>'Microfinance R G Mugabe'],
            ['branch_code'=>'ZW0010347','branch_name'=>'Microfinance Sanyati'],

        ];
        foreach ($branches as $branch) {
            Branch::create($branch);
        }
        $facilities=[
            ['facility_name'=>'John Deere','facility_description'=>'New Agricultural loan scheme']
        ];
        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
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
            ['status_code'=>'106','status_name' => 'Rolled Back'],
            ['status_code'=>'107','status_name' => 'Fully Paid'],
            ['status_code'=>'108','status_name' => 'Anomalies'],
            ['status_code'=>'109','status_name' => 'Authorised'],
        ];
        foreach ($statuses as $status) {
            Status::create($status);
        }

    }
}
