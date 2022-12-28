<?php

namespace App\Http\Controllers;

use App\Models\Modelrtd;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RtdImport;
use App\Exports\RtdExport;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Throwable;

class Fbn extends Controller
{
    public function index()
    {

        return View('layouts.master');
    }
}
