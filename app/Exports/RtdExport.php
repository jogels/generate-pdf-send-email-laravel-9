<?php

namespace App\Exports;

use App\Models\Modelrtd;
use Maatwebsite\Excel\Concerns\FromCollection;

class RtdExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Modelrtd::all();
    }
}
