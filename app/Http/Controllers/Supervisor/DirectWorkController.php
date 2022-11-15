<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\DirectWorkExport;
use App\Http\Controllers\Controller;
use App\Models\Application;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class DirectWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Application::query()->whereDate('date',Carbon::today())->paginate('10');
        return view('supervisor.direct-work.index',compact('data'));
    }

    public function approve_directWork(Request $request){

        $application=Application::find($request->id);
        $application->update([
          'direct_work_status'=>1,
        ]);
        return response()->json([
            'status' => Response::HTTP_CREATED
        ]);
    }

    public function disapprove_directWork(Request $request){
        $application=Application::find($request->id);
        $application->update([
            'direct_work_status'=>0,
        ]);
        return response()->json([
            'status' => Response::HTTP_CREATED
        ]);
    }

    public function print_selected(){
        $applications = Application::all();
        return view('supervisor.direct-work.print', compact('applications'));
    }

    public function export_directWork_excel(Request $request){
        return Excel::download(new DirectWorkExport(), 'مباشره العمل.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
