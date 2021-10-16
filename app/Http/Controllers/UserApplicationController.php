<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use App\Models\User;
use Illuminate\Http\Request;
use File;

class UserApplicationController extends Controller
{

    public function index(Request $request)
    {

       $applications = StudentApplication::where('user_id', auth()->id())->with('teacher')->get();

        return view('contents.application.index',
                   ['applications' => $applications]);
    }


    public function create()
    {  $teachers = User::where('role', 'teacher')->get();
       return view('contents.application.create')->with('teachers', $teachers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'mimes:pdf,xlx,csv|max:2048',
        ]);
        $app = StudentApplication::create($request->all());

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
<<<<<<< HEAD
        return view('contents.application.create',
               ['application' => StudentApplication::where('id', $id)->first(),
                'teachers' => User::where('role', 'teacher')->get()
               ]
    );
=======
        $application = Application::find($id);
        return view('contents.application.create',compact('application'));
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9
    }

    public function update(Request $request, $id)
    {
<<<<<<< HEAD
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
=======
       // dd($request->all());

       Application::find($id)->update($request->all());
       return redirect()->route('userapplication.index');
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9
    }

    public function destroy($id)
    {
<<<<<<< HEAD
        StudentApplication::find($id)->delete();
        return redirect()
               ->back()
               ->with('success','Successfully Deleted!');
=======
        Application::find($id)->delete();
        return redirect()->back();
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9
    }
}
