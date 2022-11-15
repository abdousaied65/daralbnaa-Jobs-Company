<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\ApplicationsExport;
use App\Models\Application;
use App\Http\Controllers\Controller;
use App\Models\ApplicationReviewer;
use App\Models\Contract;
use App\Models\Dept;
use App\Models\Employee;
use App\Models\Offer;
use App\Models\Project;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $data = Application::query()->paginate('10');
        $offers = Offer::all();
        $depts = Dept::all();
        $projects= Project::all();
        return view('supervisor.applications.index', compact('data','offers','depts','projects'));
    }

    public function create()
    {
        $used_applications = Application::all();
        $used_offers = array();
        foreach ($used_applications as $used_application){
            array_push($used_offers,$used_application->offer_id);
        }
        $offers = Offer::whereNotIn('id', $used_offers)->get();
        $depts = Dept::all();
        $projects= Project::all();
        return view('supervisor.applications.create',compact('offers','depts','projects'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'offer_id'=> 'required',
            'date'=> 'required',
            'application_type'=> 'required',
            'dept_id'=> 'required',
            'identity_number'=> 'required',
            'identity_expiration_date' => 'required',
            'basic_salary'=> 'required',
            'job_titles' => 'required',
        ]);
        $input = $request->all();
        $input['status'] = "waiting";
        $application = Application::create($input);
        $job_titles = $request->job_titles;

        $old_job_titles = ApplicationReviewer::where('application_id',$application->id)
            ->where('dept_id',$request->dept_id)->get();
        if (!$old_job_titles->isEmpty()){
            foreach ($old_job_titles as $old_job_title){
                $old_job_title->delete();
            }
        }

        foreach ($job_titles as $job_title){
            $application_reviewer = ApplicationReviewer::create([
                'application_id' => $application->id,
                'dept_id' => $request->dept_id,
                'job_title_id' => $job_title,
            ]);
        }

        $contract = Contract::create([
            'application_id' => $application->id,
            'date' => date('Y-m-d'),
            'job_title_id' => $application->offer->job_title_id,
            'employee_name' => $application->offer->employee_name,
            'nationality_id' => $application->offer->nationality_id,
            'identity_number' => $application->identity_number,
            'phone_number' =>$application->offer->phone_number ,
            'job_title_id ' => $application->offer->job_title_id,
            'contract_period' => $application->offer->contract_period,
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d', strtotime('+'.$application->offer->contract_period.' year')),
            'basic_salary' => $application->offer->basic_salary,
            'housing_allowance' => $application->offer->housing_allowance,
            'transport_allowance' => $application->offer->transport_allowance,
            'another_allowance' => $application->offer->another_allowance,
            'total_salary' => $application->offer->total_salary,
        ]);
        $nums = "0123456789";
        $job_number = substr(str_shuffle($nums),0,8);

        $password_clear = substr(str_shuffle($nums),0,8);
        $password_hashed = Hash::make($password_clear);

        $employee = Employee::Where('phone_number', $request->phone_number)->first();
        if (empty($employee)) {
            if (empty($application->project_id)){
                $employee = Employee::create([
                    'name_ar' => $contract->employee_name,
                    'name_en' => $contract->employee_name,
                    'email' => $contract->email,
                    'phone_number' => $contract->phone_number,
                    'job_number' => $job_number,
                    'password' => $password_hashed,
                    'password_clear' => $password_clear,
                    'role_name' => 'موظف',
                    'Status' => 'active',
                    'identity_number' => $contract->identity_number,
                    'passport_number' => $contract->passport_number,
                    'contract_period' => $contract->contract_period,
                    'dept_id' => $contract->application->dept->id,
                    'job_title_id' => $contract->job_title_id,
                    'nationality_id' => $contract->nationality_id,
                    'total_salary' => $contract->total_salary,
                    'weekend_vacation' => $contract->application->offer->weekend_vacation,
                    'yearly_vacation' => $contract->application->offer->yearly_vacation,
                ]);
            }
            else{
                $employee = Employee::create([
                    'name_ar' => $contract->employee_name,
                    'name_en' => $contract->employee_name,
                    'email' => $contract->email,
                    'phone_number' => $contract->phone_number,
                    'job_number' => $job_number,
                    'password' => $password_hashed,
                    'password_clear' => $password_clear,
                    'role_name' => 'موظف',
                    'Status' => 'active',
                    'identity_number' => $contract->identity_number,
                    'passport_number' => $contract->passport_number,
                    'contract_period' => $contract->contract_period,
                    'dept_id' => $contract->application->dept->id,
                    'project_id' => $contract->application->project->id,
                    'job_title_id' => $contract->job_title_id,
                    'nationality_id' => $contract->nationality_id,
                    'total_salary' => $contract->total_salary,
                    'weekend_vacation' => $contract->application->offer->weekend_vacation,
                    'yearly_vacation' => $contract->application->offer->yearly_vacation,
                ]);
            }

        }
        else{
            $employee->update([
                'password' => $password_hashed,
                'password_clear' => $password_clear,
            ]);
        }
        $contract->update([
            'employee_id' => $employee->id
        ]);

        return redirect()->route('supervisor.applications.index')
            ->with('success', trans('main.application_added'));
    }

    public function show($id)
    {
        $application = Application::findorfail($id);
        return view('supervisor.applications.show', compact('application'));
    }


    public function edit($id)
    {
        $application = Application::findOrFail($id);
        $offers = Offer::all();
        $depts = Dept::all();
        $projects= Project::all();
        $job_titles = ApplicationReviewer::where('application_id',$id)
            ->where('dept_id',$application->dept->id)->get();
        return view('supervisor.applications.edit', compact('application','job_titles','offers','depts','projects'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'offer_id'=> 'required',
            'date'=> 'required',
            'application_type'=> 'required',
            'dept_id'=> 'required',
            'identity_number'=> 'required',
            'identity_expiration_date' => 'required',
            'basic_salary'=> 'required',
            'job_titles' => 'required'
        ]);
        $input = $request->all();
        $application = Application::findOrFail($id);
        $input['status'] = "waiting";
        $application->update($input);
        $job_titles = $request->job_titles;
        $old_job_titles = ApplicationReviewer::where('application_id',$application->id)
            ->where('dept_id',$request->dept_id)->get();
        if (!$old_job_titles->isEmpty()){
            foreach ($old_job_titles as $old_job_title){
                $old_job_title->delete();
            }
        }

        foreach ($job_titles as $job_title){
            $application_reviewer = ApplicationReviewer::create([
                'application_id' => $application->id,
                'dept_id' => $request->dept_id,
                'job_title_id' => $job_title,
            ]);
        }

        return redirect()->route('supervisor.applications.index')
            ->with('success', trans('main.application_updated'));
    }

    public function destroy(Request $request)
    {
        Application::findOrFail($request->application_id)->delete();
        return redirect()->route('supervisor.applications.index')
            ->with('success', trans('main.application_deleted'));
    }

    public function remove_selected(Request $request)
    {
        $applications_id = $request->applications;
        foreach ($applications_id as $application_id) {
            $application = Application::FindOrFail($application_id);
            $application->delete();
        }
        return redirect()->route('supervisor.applications.index')
            ->with('success', trans('main.deleted'));
    }

    public function print_selected()
    {
        $applications = Application::all();
        return view('supervisor.applications.print', compact('applications'));
    }

    public function export_applications_excel()
    {
        return Excel::download(new ApplicationsExport(), 'كل قرارات التوظيف.xlsx');
    }
    public function show_offer_details(Request $request){
        $offer_id = $request->offer_id;
        $offer = Offer::FindOrFail($offer_id);
        echo "<table class='table table-bordered table-condensed table-striped'>";
        echo "<tr>";
        echo "<td>".trans('main.employee_name')."</td>";
        echo "<td>".$offer->employee_name."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.phone_number')."</td>";
        echo "<td>".$offer->phone_number."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.nationality')."</td>";
        if(App::getLocale() == "ar"){
            echo "<td>".$offer->nationality->nationality_ar."</td>";
        }
        else{
            echo "<td>".$offer->nationality->nationality_en."</td>";
        }
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.job_title')."</td>";
        if(App::getLocale() == "ar"){
            echo "<td>".$offer->job_title->job_title_ar."</td>";
        }
        else{
            echo "<td>".$offer->job_title->job_title_en."</td>";
        }
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.basic_salary')."</td>";
        echo "<td>".$offer->basic_salary."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.housing_allowance')."</td>";
        echo "<td>".$offer->housing_allowance."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.transport_allowance')."</td>";
        echo "<td>".$offer->transport_allowance."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.another_allowance')."</td>";
        echo "<td>".$offer->another_allowance."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.total_salary')."</td>";
        echo "<td>".$offer->total_salary."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.weekend_vacation')."</td>";
        echo "<td>".$offer->weekend_vacation."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.yearly_vacation')."</td>";
        echo "<td>".$offer->yearly_vacation."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.contract_period')."</td>";
        echo "<td>".$offer->contract_period."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.expired_at')."</td>";
        echo "<td>".$offer->expired_at."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.employee_response')."</td>";
        echo"<td>";

        if($offer->employee_response == "waiting"){
            echo'<span class="badge badge-md badge-warning">
                '.trans('main.'.$offer->employee_response.'').'
            </span>';
        }
        elseif($offer->employee_response == "approved"){
            echo'<span class="badge badge-md badge-success">
                '.trans('main.'.$offer->employee_response.'').'
            </span>';
        }
        elseif($offer->employee_response == "declined"){
            echo'<span class="badge badge-md badge-danger">
                '.trans('main.'.$offer->employee_response.'').'
            </span>';
        }
        echo"</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>".trans('main.created_at')."</td>";
        echo "<td>".$offer->created_at."</td>";
        echo "</tr>";

        echo "</table>";

    }
    public function show_review_details(Request $request){
        $review_id = $request->review_id;
        $review = ApplicationReviewer::FindOrFail($review_id);
        echo "<table class='table table-bordered table-condensed table-striped'>";
        echo "<tr>";
        echo "<td>".trans('main.review')."</td>";
        echo "<td>";
        if($review->review == "approved"){
            echo "<span class='badge badge-md badge-success'>
                ".trans('main.'.$review->review.'')."
            </span>";
        }
        elseif($review->review == "declined"){
            echo "<span class='badge badge-md badge-danger'>
                ".trans('main.'.$review->review.'')."
            </span>";
        }
        else{
            echo "<span class='badge badge-md badge-secondary'>
                ".trans('main.no')."
            </span>";
        }

        echo"</td>";
        echo "<td>".trans('main.created_at')."</td>";
        echo "<td>";
        if(!empty($review->review)){
            echo $review->updated_at;
        }
        else{
            echo trans('main.no');
        }
        echo"</td>";
        echo "<td>".trans('main.notes')."</td>";
        echo "<td>".$review->notes."</td>";
        echo "</tr>";
        echo "</table>";
    }
    public function update_review_details(Request $request)
    {
        $data =$request->all();
        $review_id = $request->review_id;
        $review = ApplicationReviewer::FindOrFail($review_id);
        $review->update([
            'review' => $data['review'],
            'notes' => $data['notes'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->route('supervisor.applications.index')->with('success',trans('main.review_updated'));
    }
    public function approve_application($id){
        $application = Application::FindOrFail($id);
        $application->update([
            'status' => 'approved',
            'decline_reason' => NULL
        ]);

        return redirect()->route('supervisor.applications.index')
            ->with('success', trans('main.application_approved'));
    }
    public function decline_application(Request $request){
        $application_id = $request->application_id;
        $application = Application::FindOrFail($application_id);
        $application->update([
            'status' => 'declined',
            'decline_reason' => $request->decline_reason
        ]);
        return redirect()->route('supervisor.applications.index')
            ->with('success', trans('main.application_declined'));
    }
    public function get_offer(Request $request){
        $offer_id = $request->offer_id;
        $offer = Offer::FindOrFail($offer_id);
        $basic_salary = $offer->basic_salary;
        $total_salary = $offer->total_salary;
        $transport_allowance = $offer->transport_allowance;
        $housing_allowance = $offer->housing_allowance;
        $another_allowance = $offer->another_allowance;
        return response()->json([
            'basic_salary' => $basic_salary,
            'total_salary' => $total_salary,
            'transport_allowance' => $transport_allowance,
            'housing_allowance' => $housing_allowance,
            'another_allowance' => $another_allowance,
        ]);
    }
}
