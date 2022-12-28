<?php

namespace App\Http\Controllers;

use App\Models\Modelrtd;
use App\Models\Modelkodearea;
use App\Models\Modellistmetode;
use App\Models\Modelprovinsi;
use App\Models\Modelpendidikan;
use App\Models\Modelstatusnikah;
use App\Models\Modelrtdvendor;
use App\Models\Modeldivisi;
use App\Models\Modelinactive;
use App\Models\Modelvalidasibank;
use App\Models\Modelstepvaksin;
use App\Models\Modeljenisvaksin;
use App\Models\Modeljenistraining;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RtdImport;
use App\Exports\RtdExport;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Throwable;

class Rtd extends Controller
{
    public function index()
    {
        $datartd = [
            'datartd' => Modelrtd::all()
        ];
        return View('layouts.master', $datartd);
    }

    public function add()
    {
        $kodearea = Modelkodearea::all();
        $listmetode = Modellistmetode::all();
        $provinsi = Modelprovinsi::all();
        $pendidikan = Modelpendidikan::all();
        $statusnikah = Modelstatusnikah::all();
        $rtdvendor = Modelrtdvendor::all();
        $divisi = Modeldivisi::all();
        $inactive = Modelinactive::all();
        $validasibank = Modelvalidasibank::all();
        $stepvaksin = Modelstepvaksin::all();
        $jenisvaksin = Modeljenisvaksin::all();
        $jenistraining = Modeljenistraining::all();


        return View('layouts.formadd', compact(
            'kodearea',
            'listmetode',
            'provinsi',
            'pendidikan',
            'statusnikah',
            'rtdvendor',
            'divisi',
            'inactive',
            'validasibank',
            'stepvaksin',
            'jenisvaksin',
            'jenistraining'
        ));
    }

    public function save(Request $r)
    {
        $no = $r->no;
        $status = $r->status;
        $kodearea = $r->kode_area;
        $statusarea = $r->status_kode;
        $metode = $r->metode;
        $namaintv = $r->nama_intv;
        $kotakelahiran = $r->kota_kelahiran;
        $nomorktp = $r->nomor_ktp;
        $alamatrumah = $r->alamat_rumah;
        $alamatlengkap = $r->alamat_lengkap;
        $kota = $r->kota;
        $provinsi = $r->provinsi;
        $pendidikanterakhir = $r->pendidikan_terakhir;
        $statuspernikahan = $r->status_pernikahan;
        $nohandphone = $r->no_handphone;
        $idlogin = $r->id_login;
        $idloginold = $r->id_login_old;
        $vendorname = $r->nama_vendor;
        $idvendor = $r->id_vendor;
        $divisi = $r->divisi;
        $tglbergabung = $r->tgl_bergabung;
        $tgllahir = $r->tgl_lahir;
        $gender = $r->gender;
        $statusactive = $r->status_active;
        $keluargadihubungi = $r->keluarga_dihubungi;
        $notelpalternatif = $r->telp_alternatif;
        $nowhatsapp = $r->no_whatsapp;
        $beneficiaryname = $r->beneficiary_name;
        $namabank = $r->nama_bank;
        $norekening = $r->no_rekening;
        $npwp = $r->npwp;
        $email = $r->email;
        $riwayatvaksin = $r->riwayat_vaksin;
        $alasantidakvaksin = $r->tidak_vaksin;
        $jenisvaksin = $r->jenis_vaksin;
        $training = $r->training;
        $trainer = $r->trainer;
        $helpurutlama = $r->help_urut_lama;
        $helpurut = $r->help_urut;

        // tidak ada di form

        $passwordlogin = $r->password_login;
        $tglvaksinke1 = $r->tgl_vaksin_1;
        $tglvaksinke2 = $r->tgl_vaksin_2;
        $tglblacklistsuspend = $r->tgl_blacklist_suspend;
        $tglselesaisuspend = $r->tgl_selesai_suspend;
        $tgltraining = $r->tgl_training;
        $mentortraining1 = $r->mentor_training1;


        try {
            $rtd = new \App\Models\Modelrtd();
            $rtd->No = $no;
            $rtd->Status = $status;
            $rtd->NamaArea = $kodearea;
            $rtd->KodeAREA =  $statusarea;
            $rtd->Metode =  $metode;
            $rtd->Nama = $namaintv;
            $rtd->Tempat_Kelahiran =  $kotakelahiran;
            $rtd->KTP =   $nomorktp;
            $rtd->Alamat = $alamatrumah;
            $rtd->Alamat_Saat_Ini = $alamatlengkap;
            $rtd->Kota =  $kota;
            $rtd->Provinsi = $provinsi;
            $rtd->Pendidikan_Terakhir = $pendidikanterakhir;
            $rtd->Status_Pernikahan = $statuspernikahan;
            $rtd->Nomor_Handphone = $nohandphone;
            $rtd->ID_INTV = $idlogin;
            $rtd->ID_INTV_LAMA = $idloginold;
            $rtd->VendorName =  $vendorname;
            $rtd->IDVENDOR =  $idvendor;
            $rtd->Divisi = $divisi;
            $rtd->Tanggal_Bergabung =  $tglbergabung;
            $rtd->Tanggal_Lahir = $tgllahir;
            $rtd->Jenis_Kelamin = $gender;
            $rtd->Status_Active = $statusactive;
            $rtd->NamaKeluargaAlternative = $keluargadihubungi;
            $rtd->NoTELPKeluargaAlternative = $notelpalternatif;
            $rtd->Nomor_WA = $nowhatsapp;
            $rtd->Beneficiary_Name = $beneficiaryname;
            $rtd->Nama_Bank = $namabank;
            $rtd->Nomor_Rekening = $norekening;
            $rtd->NPWP = $npwp;
            $rtd->Email =  $email;
            $rtd->RiwayatVaksinCovid = $riwayatvaksin;
            $rtd->AlasanBelumVaksin = $alasantidakvaksin;
            $rtd->Jenis_Vaksin =  $jenisvaksin;
            $rtd->Judul_Training =  $training;
            $rtd->Mentor_Training = $trainer;
            $rtd->Help_Urut_Lama = $helpurutlama;
            $rtd->Help_Urut = $helpurut;

            // tidak ada di form

            $rtd->Password_Login = $passwordlogin;
            $rtd->Tanggal_Vaksin_Ke_1 = $tglvaksinke1;
            $rtd->Tanggal_Vaksin_Ke_2 = $tglvaksinke2;
            $rtd->Tanggal_Blacklist_Suspend = $tglblacklistsuspend;
            $rtd->Tanggal_Selesai_Suspend = $tglselesaisuspend;
            $rtd->Tgl_Training = $tgltraining;
            $rtd->Mentor_Training1 = $mentortraining1;


            $rtd->save();

            echo 'Data berhasil tersimpan';
            // return redirect()->back();
        } catch (Throwable $e) {
            echo $e;
        }
    }

    public function import()
    {
        Excel::import(new RtdImport, request()->file('file')->store('files'));

        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new RtdExport, "rtd.xlsx");
    }
}
