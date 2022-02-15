<?php

namespace App\Http\Controllers;

use App\Mail\SendAppMail;
use App\Models\AppRole;
use App\Models\StudentApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationCheckController extends Controller
{
    public function index(Request $request) {
        $app_id = $request->id;

        $singleApp = null;
        if ($app_id) {
            $singleApp = StudentApplication::where('id', $app_id)->first();
        }

        $applications = StudentApplication::whereIn('status', [1,2,0])->where('teacher_id', auth()->id())->get();
        $managements = User::whereIn('role_id',[3,4,5,6,7])->get();
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
               ->with('success', 'Application has been Sent!');
    }
    public function updateStatusAccept ($id) {
        $app = StudentApplication::where('id', $id)->first();
                          $app->update(['status' => 1]);
        Mail::to($app->user->email)->send(new SendAppMail($app));
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

    public function sendToMangement (Request $request) {

        $this->validate($request, [
            'app_id' => 'required',
            'id' =>'required'
        ]);

        AppRole::updateOrCreate(['user_id' => $request->id,
        'student_application_id' => $request->app_id,
        'sender_id' => auth()->id()],[
            'user_id' => $request->id,
            'student_application_id' => $request->app_id,
            'sender_id' => auth()->id()
        ]);

        return response()->json(['success' => true], 200);

    }
}

