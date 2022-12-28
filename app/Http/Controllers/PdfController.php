<?php

namespace App\Http\Controllers;
// use App\Http\Requests;  
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    //Generate PDF
    public function exportPdf(Request $r)
    {
        //nama file pdf untuk FBN
        $filePDF =  time() . '.' . 'pdf';

        //Tambah Data FBN ke database
        $sup = new \App\Models\Fbn();
        $sup->id_buafm = $r->id_buafm;
        $sup->id_pic = $r->id_pic;
        $sup->project_number = $r->project_number;
        $sup->background = $r->background;
        $sup->file = $filePDF;
        if ($r->hasFile('image')) {
            $file = $r->file('image');
            $extension = strtolower($file->getClientOriginalExtension()); //get image extension
            $filename =  time() . '.' . $extension;
            $file->move('images/', $filename);
            $sup->gambar = $filename;
        } else {
            $sup->gambar = '';
        }
        $sup->save();

        $lastidFBN = \App\Models\Fbn::pluck('id')->last(); //

        //Update id fbn pada tabel tabel yang berelasi dengan FBN
        \App\Models\Timing::where('id_fbn', 0)->update(['id_fbn' => $lastidFBN]);
        \App\Models\Baris::where('id_fbn', 0)->update(['id_fbn' => $lastidFBN]);
        \App\Models\Kolom::where('id_fbn', 0)->update(['id_fbn' => $lastidFBN]);
        \App\Models\Tabel::where('id_fbn', 0)->update(['id_fbn' => $lastidFBN]);

      
        $data = [
            'id_fbn'    => $lastidFBN,
            
        ];
        $pdf = PDF::loadView('cetak-pdf',$data); // <--- load your view into theDOM wrapper;
        $path = public_path('pdf_docs/'); // <--- folder to store the pdf documents into the server;
        // <--giving the random filename,
        $pdf->save($path . '/' . $filePDF);
        $generated_pdf_link = url('pdf_docs/' . $filePDF);

        



       
        // return $pdf->download('fbn.pdf');
        return redirect()->back()->with('success', 'Berhasil Generate PDF di Menu History');

        // return $pdf->download('fbn.pdf');
        //return response()->download($pdf);

    }
    
    public function editexportPdf(Request $r)
    {
        //nama file pdf untuk FBN
        $filePDF =  time() . '.' . 'pdf';

        //Tambah Data FBN ke database
        $sup = \App\Models\Fbn::where('id',$r->id)->first();
        $sup->id_buafm = $r->id_buafm;
        $sup->id_pic = $r->id_pic;
        $sup->project_number = $r->project_number;
        $sup->background = $r->background;
        $sup->file = $filePDF;
        if ($r->hasFile('image')) {
            $file = $r->file('image');
            $extension = strtolower($file->getClientOriginalExtension()); //get image extension
            $filename =  time() . '.' . $extension;
            $file->move('images/', $filename);
            $sup->gambar = $filename;
        }
        $sup->save();



        $data = [
            'id_fbn'    => $r->id,
       ];
        $pdf = PDF::loadView('cetak-pdf',$data); // <--- load your view into theDOM wrapper;
        $path = public_path('pdf_docs/'); // <--- folder to store the pdf documents into the server;
        // <--giving the random filename,
        $pdf->save($path . '/' . $filePDF);
        $generated_pdf_link = url('pdf_docs/' . $filePDF);

        

      

       
        // $pdf->download('fbn.pdf');
        // return redirect()->back()->with('success', 'Berhasil Generate PDF di Menu History');

        return $pdf->download($filePDF);
        //return response()->download($pdf);

    }
    

    public function download($file){
        $file_path = public_path('pdf_docs/'.$file);
        return response()->download($file_path);
    }


    //CRUD AJAX timing
    public function addtiming(Request $r)
    {
        if ($r->activity == '' || $r->timeline == '') {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Lengkapi data terlebih dahulu'
                ]
            );
        } else {
            //berhasill
            $sup = new \App\Models\Timing();
            $sup->activity = $r->activity;
            $sup->timeline = $r->timeline;
            $sup->id_fbn = $r->id_fbn;

            $sup->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Berhasil menambah data'
                ]
            );
        }
    }

    public function deletetiming(Request $r)
    {

        $sup = \App\Models\Timing::where('id', $r->id)->first()->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'Berhasil menghapus data'
            ]
        );
    }


    // CUSTOM TABLE
    public function addRow(Request $r)
    {
        if ($r->baris == '') {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Lengkapi data terlebih dahulu'
                ]
            );
        } else {
            //berhasill
            $sup = new \App\Models\Baris();
            $sup->baris = $r->baris;
            $sup->id_fbn = $r->id_fbn;
            $sup->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Berhasil menambah baris'
                ]
            );
        }
    }

    public function addColumn(Request $r)
    {
        if ($r->kolom == '') {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Lengkapi data terlebih dahulu'
                ]
            );
        } else {
            //berhasill
            $sup = new \App\Models\Kolom();
            $sup->kolom = $r->kolom;
            $sup->id_fbn = $r->id_fbn;
            $sup->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Berhasil menambah kolom',

                ]
            );
        }
    }

    public function addData(Request $r)
    {
        if ($r->id_baris == '' || $r->id_kolom == '' || $r->nilai == '') {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Lengkapi data terlebih dahulu'
                ]
            );
        } else {
            //berhasill
            $sup = new \App\Models\Tabel();
            $sup->id_fbn = $r->id_fbn;
            $sup->id_kolom = $r->id_kolom;
            $sup->id_baris = $r->id_baris;
            $sup->nilai = $r->nilai;

            $sup->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Berhasil menambah data'
                ]
            );
        }
    }

    public function deleteRow(Request $r)
    {

        $sup = \App\Models\Baris::where('id', $r->id)->first()->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'Berhasil menghapus data'
            ]
        );
    }

    public function deleteColumn(Request $r)
    {

        $sup = \App\Models\Kolom::where('id', $r->id)->first()->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'Berhasil menghapus data'
            ]
        );
    }



}
