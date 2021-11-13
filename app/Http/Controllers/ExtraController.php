<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use Illuminate\Http\Request;
use PDF;
class ExtraController extends Controller
{
    public function createPdf (Request $request,$id) {
        $application = StudentApplication::with('teacher')->find($id);
        return view('contents.make-pdf.pdf-template', compact('application'));
    }

    public function downloadPDF(Request $request) {
        // retreive all records from db
        $data = StudentApplication::with('teacher')->find($request->id);

        // share data to view
        view()->share('application',$data);
        $pdf = PDF::loadView('contents.make-pdf.pdf-template', $data)->setOptions(['defaultFont' => 'sans-serif']);

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
      }


}
