<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use Illuminate\Http\Request;

class ApplicationCheckController extends Controller
{
    public function index() {
        $applications = StudentApplication::whereIn('status', [1,2,0])->where('teacher_id', auth()->id())->get();
        return view('contents.application-check.index',
                    ['applications'=> $applications]
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
