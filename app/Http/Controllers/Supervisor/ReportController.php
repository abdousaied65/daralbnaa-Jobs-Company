<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function contracts_waiting(){
        $contracts = Contract::query()->where('status','waiting')->paginate('10');
        return view('supervisor.reports.waiting',compact('contracts'));
    }
    public function contracts_pending(){
        $contracts = Contract::query()->where('status','pending')->paginate('10');
        return view('supervisor.reports.pending',compact('contracts'));
    }
    public function contracts_approved(){
        $contracts = Contract::query()->where('status','approved')->paginate('10');
        return view('supervisor.reports.approved',compact('contracts'));
    }
    public function contracts_declined(){
        $contracts = Contract::query()->where('status','declined')->paginate('10');
        return view('supervisor.reports.declined',compact('contracts'));
    }
    public function contracts_expired(){
        $contracts = Contract::query()->where('status','expired')->paginate('10');
        return view('supervisor.reports.expired',compact('contracts'));
    }

    public function contracts_custom(){
        return view('supervisor.reports.custom');
    }
    public function contracts_custom_report(Request $request){
        $period = $request->period;
        $from_date = date('Y-m-d');
        $to_date = date('Y-m-d', strtotime($from_date . ' +' . $period . ' day'));
        $contracts = Contract::query()
            ->whereBetween('end_date', [$from_date, date('Y-m-d', strtotime($to_date . ' +1 day'))])
            ->paginate('10');
        return view('supervisor.reports.custom',compact('contracts','period'));
    }
}
