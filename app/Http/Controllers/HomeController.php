<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Customer;
use App\Loan;
use App\LoanSchedule;
use App\Notifications\LoanAdvice;
use App\User;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use OwenIt\Auditing\Models\Audit;
use Spatie\Permission\Models\Role;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function audits(){
        $audits=Audit::all();
        return view('audit',compact('audits'));
    }

    public function index()
    {
        $customers = Customer::all()->groupBy('branch_code');
//       // dd($customers);
//        foreach ($customers as $customer){
//            dd(count($customer));
//             }
        $assets = Asset::all()->count();

        $allocated=Asset::where('status','100')->count();
        $reserved=Asset::where('status','101')->count();
        $remaining=Asset::where('status','102')->count();
        $data=Charts::create('donut', 'highcharts')
            ->title('Assets Statistics')
            ->elementLabel('Total Count')
            ->labels(['Total Assets','Available', 'Allocated', 'Reserved'])
            ->values([$assets,$remaining,$allocated,$reserved])
            ->colors(['#0f9b0f','#f7b733','#b20a2c','#CAC531','#48b1bf','#E100FF','#7F00FF','#667db6','#667db6','#fc4a1a','#302b63'])
            ->responsive(true);
        $clients=Charts::database(Customer::all(),'bar','highcharts')
            ->title('Total Clients Per Branch')
            ->colors(['#302b63','#CAC531','#b20a2c','#0f9b0f','#48b1bf','#E100FF','#7F00FF','#667db6','#00F260','#667db6','#f7b733','#fc4a1a'])
            ->responsive(true)
            ->ElementLabel('Total Clients')
            ->groupBy('branch_code');
        $totalloans=Charts::database(Loan::all(),'pie','highcharts')
            ->title('Total Loans Per Branch')
            ->colors(['#48b1bf','#E100FF','#7F00FF','#fc4a1a','#302b63','#CAC531','#00F260','#667db6','#f7b733','#b20a2c','#0f9b0f','#667db6'])
            ->responsive(true)
            ->ElementLabel('Total Count')
            ->groupBy('branch');
        $unauthorised=Charts::database(Loan::where('status','=','103')->get(),'bar','highcharts')
            ->title('Unauthorised Loans Per Branch')
            ->colors(['#b20a2c'])
            ->responsive(true)
            ->ElementLabel('Total Count')
            ->groupBy('branch');

        $realtime=Charts::realtime(route('realtime'),1000,'line','highcharts')
            ->title('Realtime Loan Processing')
            ->responsive(true)
            ->colors(['#0f9b0f','#f7b733','#b20a2c','#CAC531','#48b1bf','#E100FF','#7F00FF','#667db6','#667db6','#fc4a1a','#302b63']);

        return view('home',compact('data','clients','realtime','unauthorised','totalloans'));
    }
}
