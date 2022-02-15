<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __invoke(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $query = User::query()->with('student_applications')->where('role_id', User::STUDENT);
        if ($request->from && $request->to) {
            $query->whereHas('student_applications', function ($q) use ($from, $to) {
                $q->whereBetween('created_at', [$from, $to]);
            });
        }
        $users = $query->get();

        return view('contents.reports.index', compact('users', 'from', 'to'));
    }
}
