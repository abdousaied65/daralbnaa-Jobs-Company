<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\OffersExport;
use App\Models\Offer;
use App\Http\Controllers\Controller;
use App\Models\JobTitle;
use App\Models\Nationality;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $data = Offer::query()->paginate('10');
        $nationalities = Nationality::all();
        $job_titles = JobTitle::all();
        return view('supervisor.offers.index', compact('data', 'nationalities', 'job_titles'));
    }

    public function create()
    {
        $nationalities = Nationality::all();
        $job_titles = JobTitle::all();
        return view('supervisor.offers.create', compact('nationalities', 'job_titles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'employee_name' => 'required',
            'phone_number' => 'required',
            'contract_period' => 'required',
            'job_title_id' => 'required',
            'nationality_id' => 'required',
            'basic_salary' => 'required',
            'housing_allowance' => 'required',
            'transport_allowance' => 'required',
            'another_allowance' => 'required',
            'total_salary' => 'required',
            'weekend_vacation' => 'required',
            'yearly_vacation' => 'required'
        ]);
        $input = $request->all();
        $input['expired_at'] = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +2 day'));
        $offer = Offer::create($input);
        return redirect()->route('supervisor.offers.index')
            ->with('success', trans('main.offer_added'));
    }

    public function show($id)
    {
        $offer = Offer::findorfail($id);
        return view('supervisor.offers.show', compact('offer'));
    }


    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $nationalities = Nationality::all();
        $job_titles = JobTitle::all();
        return view('supervisor.offers.edit', compact('offer', 'nationalities', 'job_titles'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'employee_name' => 'required',
            'phone_number' => 'required',
            'contract_period' => 'required',
            'job_title_id' => 'required',
            'nationality_id' => 'required',
            'basic_salary' => 'required',
            'housing_allowance' => 'required',
            'transport_allowance' => 'required',
            'another_allowance' => 'required',
            'total_salary' => 'required',
            'weekend_vacation' => 'required',
            'yearly_vacation' => 'required'
        ]);
        $input = $request->all();
        $offer = Offer::findOrFail($id);
        $offer->update($input);
        return redirect()->route('supervisor.offers.index')
            ->with('success', trans('main.offer_updated'));
    }

    public function destroy(Request $request)
    {
        Offer::findOrFail($request->offer_id)->delete();
        return redirect()->route('supervisor.offers.index')
            ->with('success', trans('main.offer_deleted'));
    }

    public function remove_selected(Request $request)
    {
        $offers_id = $request->offers;
        foreach ($offers_id as $offer_id) {
            $offer = Offer::FindOrFail($offer_id);
            $offer->delete();
        }
        return redirect()->route('supervisor.offers.index')
            ->with('success', trans('main.deleted'));
    }

    public function print_selected()
    {
        $offers = Offer::all();
        return view('supervisor.offers.print', compact('offers'));
    }

    public function export_offers_excel()
    {
        return Excel::download(new OffersExport(), 'كل العروض الوظيفية.xlsx');
    }

    public function send_offer_sms($id)
    {
        $offer = Offer::FindOrFail($id);
        $phone_number = $offer->phone_number;
        $message = "نتشرف ان نتقدم لكم بالعرض الوظيفي
كما هو موضح بالمميزات الوظيفية
بناءا على المقابلة الشخصية
" . route('get.offer.details', $offer->id) . "
";
        $response = Http::get('https://www.msegat.com/gw/Credits.php', [
            'userName' => env('SMS_userName'),
            'apiKey' => env('SMS_apiKey'),
            'msgEncoding' => env('SMS_msgEncoding'),
        ]);
        $credits = round($response->body(), 2);
        if ($credits > 1) {
            $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
                'userName' => env('SMS_userName'),
                'apiKey' => env('SMS_apiKey'),
                'numbers' => $phone_number,
                'userSender' => env('SMS_userSender'),
                'msg' => $message,
                'msgEncoding' => env('SMS_msgEncoding'),
                'reqFilter' => 'false',
            ]);
            return redirect()->route('supervisor.offers.index')->with('success', trans('main.offer_sent'));
        }
    }

    public function get_offer_details($id)
    {
        $offer = Offer::FindOrFail($id);
        return view('supervisor.offers.offer_details', compact('offer'));
    }

    public function post_offer_details(Request $request, $id)
    {
        $phone_number = $request->phone_number;
        $input = $request->all();
        $offer = Offer::where('phone_number', $phone_number)
            ->where('id', $id)
            ->first();
        if (!empty($offer)) {
            if ($offer->expired_at < date('Y-m-d H:i:s')) {
                return redirect()->route('get.offer.details', $id)->withInput()
                    ->with('error', trans('main.offer_expired'));
            } else {
                return view('supervisor.offers.offer_details_confirmed', compact('offer'));
            }
        } else {
            return redirect()->route('get.offer.details', $id)->withInput()
                ->with('error', trans('main.data_not_correct'));
        }
    }

    public function approve_offer(Request $request)
    {
        $offer = Offer::FindOrFail($request->offer_id);
        $offer->update([
            'employee_response' => 'approved',
            'decline_reason' => '',
        ]);
        return redirect()->route('get.offer.details', $offer->id)
            ->with('success', trans('main.offer_approved'));
    }

    public function decline_offer(Request $request)
    {
        $decline_reason = $request->decline_reason;
        $offer = Offer::FindOrFail($request->offer_id);
        $offer->update([
            'employee_response' => 'declined',
            'decline_reason' => $decline_reason,
        ]);
        return redirect()->route('get.offer.details', $offer->id)
            ->with('success', trans('main.offer_declined'));
    }

}
