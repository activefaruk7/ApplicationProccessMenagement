<?php

namespace App\Http\Controllers;

use App\Models\AppRole;
use App\Models\StudentApplication;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index(Request $request) {
        $app_id = $request->id;

        $singleApp = null;
        if ($app_id) {

            $singleApp = StudentApplication::where('id', $app_id)->first();
        }
        $apps = StudentApplication::whereHas('app_role', function ($q) {
            $q->where('user_id', auth()->id());
        })->get();
        
        return view('contents.management-app-check.index', compact('apps','singleApp'));
    }
}