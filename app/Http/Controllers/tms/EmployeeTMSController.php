<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use App\Models\EmployeeTMS;
use App\Models\Question;
use App\Models\QuestionBank;
use App\Models\Quize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RecordNumber;
use Carbon\Carbon;


class EmployeeTMSController extends Controller
{
    // public function index()
    // {
    //     $empolyee = EmployeeTMS::get();
    //     return view('frontend.tms.index', compact('empolyee'));
    // }

public function employeeShow($id){
    $data = EmployeeTMS::find($id);
    // return $employee;
    return view('frontend.TMS.employee_tms_view', compact('data'));
}

    public function store(Request $request)
    {
        $employeeTms = new EmployeeTMS();        
        $employeeTms->record_number = ((RecordNumber::first()->value('counter')) + 1);
        $employeeTms->division_id = $request->division_id;
        $employeeTms->initiator = Auth::user()->id;
        $employeeTms->intiation_date = $request->intiation_date;
        $employeeTms->assign_to = $request->assign_to;
        $employeeTms->due_date = $request->due_date;
        $employeeTms->actual_Start_Date = $request->actual_Start_Date;
        $employeeTms->employee_ID = $request->employee_ID;
        $employeeTms->gender = $request->gender;
        $employeeTms->department_name = $request->department_name;
        $employeeTms->job_title = $request->job_title;

        $employeeTms->floor = $request->floor;
        $employeeTms->zone = $request->zone;
        $employeeTms->country = $request->country;
        $employeeTms->city = $request->city;
        $employeeTms->room = $request->room;
        $employeeTms->comment = $request->comment;
        $employeeTms->sitename = $request->sitename;
        $employeeTms->building = $request->building;
        $employeeTms->status = 'Opened';
        $employeeTms->stage = 1;

        if (!empty ($request->attached_cv)) {
            $files = [];
            if ($request->hasfile('attached_cv')) {
                foreach ($request->file('attached_cv') as $file) {
                    $name = $request->name . 'attached_cv' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $employeeTms->attached_cv = json_encode($files);
        }

        if (!empty ($request->certificateClassification)) {
            $files = [];
            if ($request->hasfile('certificateClassification')) {
                foreach ($request->file('certificateClassification') as $file) {
                    $name = $request->name . 'certificateClassification' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $employeeTms->certificateClassification = json_encode($files);
        }

        if (!empty ($request->picture)) {
            $files = [];
            if ($request->hasfile('picture')) {
                foreach ($request->file('picture') as $file) {
                    $name = $request->name . 'picture' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $employeeTms->picture = json_encode($files);
        }



        $employeeTms->save();
      


        toastr()->success("Record is created Successfully");
        return redirect(url('TMS'));
    }

    public function employeeById($id){
        $data = EmployeeTMS::find($id);
        return view('frontend.TMS.employee_tms_view', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $lastEmployeeTms = EmployeeTMS::find($id);
        $employeeTms = EmployeeTMS::find($id);

        $employeeTms = new EmployeeTMS();        
        // $employeeTms->record_number = ((RecordNumber::first()->value('counter')) + 1);
        // $employeeTms->division_id = $request->division_id;
        // $employeeTms->initiator = Auth::user()->id;
        // $employeeTms->intiation_date = $request->intiation_date;
        $employeeTms->assign_to = $request->assign_to;
        // $employeeTms->due_date = $request->due_date;
        // $employeeTms->actual_Start_Date = $request->actual_Start_Date;
        // $employeeTms->employee_ID = $request->employee_ID;
        $employeeTms->gender = $request->gender;
        $employeeTms->department_name = $request->department_name;
        $employeeTms->job_title = $request->job_title;

        $employeeTms->floor = $request->floor;
        $employeeTms->zone = $request->zone;
        $employeeTms->country = $request->country;
        $employeeTms->city = $request->city;
        $employeeTms->room = $request->room;
        $employeeTms->comment = $request->comment;
        $employeeTms->sitename = $request->sitename;
        $employeeTms->building = $request->building;

        if (!empty ($request->attached_cv)) {
            $files = [];
            if ($employeeTms->attached_cv) {
                $files = is_array(json_decode($employeeTms->attached_cv)) ? $employeeTms->attached_cv : [];
            }

            if ($request->hasfile('attached_cv')) {
                foreach ($request->file('attached_cv') as $file) {
                    $name = $request->name . 'attached_cv' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $employeeTms->attached_cv = json_encode($files);
        }

        if (!empty ($request->certificateClassification)) {
            $files = [];
            if ($employeeTms->certificateClassification) {
                $files = is_array(json_decode($employeeTms->certificateClassification)) ? $employeeTms->certificateClassification : [];
            }

            if ($request->hasfile('certificateClassification')) {
                foreach ($request->file('certificateClassification') as $file) {
                    $name = $request->name . 'certificateClassification' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $employeeTms->certificateClassification = json_encode($files);
        }

        if (!empty ($request->picture)) {
            $files = [];
            if ($employeeTms->picture) {
                $files = is_array(json_decode($employeeTms->picture)) ? $employeeTms->picture : [];
            }

            if ($request->hasfile('picture')) {
                foreach ($request->file('picture') as $file) {
                    $name = $request->name . 'picture' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $employeeTms->picture = json_encode($files);
        }



        $employeeTms->save();
      


        toastr()->success('Record is Update Successfully');
        return back();
    }
}