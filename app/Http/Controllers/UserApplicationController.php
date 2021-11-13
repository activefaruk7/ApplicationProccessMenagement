<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\StudentApplication;
use App\Models\User;
use Illuminate\Http\Request;
use File;

class UserApplicationController extends Controller
{

    public function index(Request $request)
    {

       $applications = StudentApplication::where('user_id', auth()->id())->with('teacher')->get();
        $messages = Message::where('user_id', auth()->id())->latest()->get();
        return view('contents.application.index',
                   ['applications' => $applications,
                    'messages' => $messages]);
    }


    public function create()
    {  $teachers = User::where('role_id', 2)->get();
       $managements = User::whereNotIn('role_id', [1,2])->get();

       return view('contents.application.create', compact('teachers', 'managements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'mimes:pdf,xlx,csv|max:2048',
        ]);
        $app = StudentApplication::create($request->all());
        foreach($request->management_id as $id) {
            $app->app_role()->create([
                'user_id' => $id,
                'sender_id' => auth()->id()
            ]);
        }

        if ($request->hasFile('file')) {
            $name = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $name, 'public');


            $app->file = '/storage/' . $filePath;

            $app->update();
        }

       return redirect()
              ->route('userapplication.index')
              ->with('success', 'Application Updated Successfully');          ;
    }


    public function show($id)
    {

        return view('contents.application-check.show',
               ['application' => StudentApplication::where('id', $id)->first()]
        );
    }


    public function edit($id)
    {
        return view('contents.application.create',
               ['application' => StudentApplication::where('id', $id)->first(),
                'teachers' => User::where('role_id', 2)->get(),
               ]
    );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'mimes:pdf,doc,docx,xlx,csv|max:2048',
        ]);

        $app = StudentApplication::find($id);
        $app->update($request->all());

        if ($request->hasFile('file')) {
            if (File::exists($app->file)) {
                File::delete($app->file);
            }
            $name = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $name, 'public');
            $app->file = '/storage/' . $filePath;

            $app->update();
        }

       return redirect()
              ->route('userapplication.index')
              ->with('success', 'Application Saved Successfully');
    }

    public function destroy($id)
    {
        StudentApplication::find($id)->delete();
        return redirect()
               ->back()
               ->with('success','Successfully Deleted!');
    }
}
