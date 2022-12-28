<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\KirimEmail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class MailController extends Controller
{
    public function kirimEmail(Request $r)
    {
        // $r->nama itu ID
        $bu_afm = \App\Models\BuAfm::where('id',$r->nama)->first();

        $details = [
            'nama' => $bu_afm->nama,
            'link' => 'https://fbn.isystemops.com/edit-pdf/' . $r->id
            
        ];

        \Mail::to($bu_afm->email)->send(new \App\Mail\KirimEmail($details));

        return redirect()->back()->with('success', 'Email berhasil terkirim');
    }

    //Multiple Email 
    public function kirimEmail2($id)
    {
        // $r->nama itu ID
        $emails = array();
        $names = array();

        $fbn = \App\Models\Fbn::where('id',$id)->first();

        $emails[] = \App\Models\BuAfm::where('id',$fbn->id_buafm)->pluck('email')->first();
        $emails[] = \App\Models\Pic::where('id',$fbn->id_pic)->pluck('email')->first();

        $names[] = \App\Models\BuAfm::where('id',$fbn->id_buafm)->pluck('nama')->first();
        $names[] = \App\Models\Pic::where('id',$fbn->id_pic)->pluck('nama')->first();

        // dd($names);

        $details = [
            'nama' => $names,
            'link' => 'https://fbn.isystemops.com/edit-pdf/' . $id
            
        ];

        
        \Mail::to($emails)->send(new \App\Mail\KirimEmail($details));

        return redirect()->back()->with('success', 'Email berhasil terkirim');
    }

}
