<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Hash;

class Profilecontroller extends Controller
{
    public function index (Request $request) {
        $tab = $request->tab;
        return view('contents.profile.index', compact('tab'));
    }

    public function update (Request $request) {
        // dd($request->all());
        $att = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => 'nullable',
            'address' => 'nullable|string',
        ]);

        $user = User::find(auth()->id());
        $user->update($att);
        return redirect()->back()->with('success', "Successfully updated!");
    }

    public function updatePassword (Request $request) {
        // dd($request->all());
        $this->validate($request, [
            'old_password' => ['string', 'required'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('error', "Old password Doesn't match! Please try again");
        }

        $user = User::find(auth()->id());
        $user->password = bcrypt($request->password);
        $user->save();
        return back()->with('success', 'password change successfully!!');
    }

    public function avaterUpdate (Request $request) {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);

          if ($request->hasFile('image')) {
            $user = User::find($request->id);

            if (File::exists(public_path($user->avater))) {
                File::delete(public_path($user->avater));
            }

            $files = $request->file('image');
            $imagename = rand(45464, 676767).time().'_'.uniqid().'.'.$files->getClientOriginalExtension();
            $imagepublicpath = public_path('storage/files');
            $files->move($imagepublicpath, $imagename);
            $file_path = '/storage/files/'.$imagename;

            $user->avater = $file_path;
            $user->save();

        }
        return response()->json(['success', "Image Succefully Uploaded"]);
    }
}

