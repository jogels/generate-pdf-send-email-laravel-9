<?php

namespace App\Imports;

use App\Models\Modelrtd;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RtdImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Modelrtd([
            // 'No' => $row[0],
            'IDVENDOR' => $row[1],
            'VendorName' => $row[2],
            'kodeAREA' => $row[3],
            'Help_Urut_Lama' => $row[4],
            'Help_Urut' => $row[5],
            'NamaArea' => $row[6],
            'Status' => $row[7],
            'Divisi' => $row[8],
            'Metode' => $row[9],
            'ID_INTV_LAMA' => $row[10],
            'ID_INTV' => $row[11],
            'Password_Login' => $row[12],
            'Nama' => $row[13],
            'Jenis_Kelamin' => $row[14],
            'Tanggal_Bergabung' => date('Y-m-d'),
            'Alamat_Saat_Ini' => $row[16],
            'Kota' => $row[17],
            'Provinsi' => $row[18],
            'Nomor_Handphone' => $row[19],
            'Nomor_WA' => $row[20],
            'Email' => $row[21],
            'Tempat_Kelahiran' => $row[22],
            'Tanggal_Lahir' => date('Y-m-d'),
            'KTP' => $row[24],
            'Alamat' => $row[25],
            'Status_Pernikahan' => $row[26],
            'Nomor_Rekening' => $row[27],
            'Nama_Bank' => $row[28],
            'NPWP' => $row[29],
            'Pendidikan_Terakhir' => $row[30],
            'NamaKeluargaAlternative' => $row[31],
            'NoTELPKeluargaAlternative' => $row[32],
            'RiwayatVaksinCovid' => $row[33],
            'AlasanBelumVaksin' => $row[34],
            'Jenis_Vaksin' => $row[35],
            'Tanggal_Vaksin_Ke_1' => date('Y-m-d'),
            'Tanggal_Vaksin_Ke_2' => date('Y-m-d'),
            'Beneficiary_Name' => $row[38],
            'Status_Active' => $row[39],
            'Tanggal_Blacklist_Suspend' => date('Y-m-d'),
            'Tanggal_Selesai_Suspend' => date('Y-m-d'),
            'Judul_Training' => $row[42],
            'Tgl_Training' => date('Y-m-d'),
            'Mentor_Training' => '',
            // 'Mentor_Training1' => $row[45],


            // tidak ada di form




        ]);
    }
}
