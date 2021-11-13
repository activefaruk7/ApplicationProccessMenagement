<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use App\Models\User;
use Illuminate\Http\Request;

class ApplicationCheckController extends Controller
{
    public function index(Request $request) {
        $app_id = $request->id;

        $singleApp = null;
        if ($app_id) {

            $singleApp = StudentApplication::where('id', $app_id)->first();
        }

        $applications = StudentApplication::whereIn('status', [1,2,0])->where('teacher_id', auth()->id())->get();
        $managements = User::whereIn('id',[3,4,5,6,7])->get();
        return view('contents.application-check.index',
                    ['applications'=> $applications,
                     'singleApp' => $singleApp,
                     'managements' => $managements]
                    );
    }

    public function updateStatusPanding ($id) {
        StudentApplication::where('id', $id)
                          ->update(['status' => 2]);
        return redirect()
               ->back()
               ->with('success', 'Application Sended!');
    }
    public function updateStatusAccept ($id) {
        StudentApplication::where('id', $id)
                          ->update(['status' => 1]);
        return redirect()
               ->back()
               ->with('success', 'Application Accepted!');
    }
    public function updateStatusReject ($id) {
        StudentApplication::where('id', $id)
                          ->update(['status' => 0]);
        return redirect()
               ->back()
               ->with('success', 'Application Rejected!');
    }

    public function docOpen ($id) {
        return view('contents.application-check.doc', array('application' => StudentApplication::where('id', $id)->first()));
    }
}
