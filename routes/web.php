<?php

use App\Http\Controllers\Rtd;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.master');
})->name('dashboard');

//EDIT PDF
Route::get('/edit-pdf/{id}', function ($id) {
    return view('layouts.edit-pdf')->with('id', $id);
})->name('edit-pdf');


Route::get('/history', function () {
    return view('layouts.history');
})->name('history');
Route::get('/test', function () {
    return view('test');
})->name('test');


Route::get('/test-print', function () {
    return view('test');
});
Route::post('/export-pdf', [App\Http\Controllers\PdfController::class, 'exportPdf'])->name('exportPdf');
Route::put('edit-export-pdf', 'PdfController@editexportPdf')->name('editexportPdf');
Route::get('pdfview', array('as' => 'pdfview', 'uses' => 'PdfController@pdfview'));
// Route::get('generatepdf',[PdfController::class,'generatepdf'])->name('generatepdf');
// Route::post('/generatepdf', 'PdfController@generatepdf')->name('generatepdf');
Route::get('/generatepdf', 'PdfController@generatepdf')->name('generatepdf');


Route::post('addtiming', 'PdfController@addtiming')->name('addtiming');
Route::get('deletetiming', 'PdfController@deletetiming')->name('deletetiming');
Route::get('/refresh-timing-detail', function () {
    return view('ajax.refresh-timing-detail');
});
//EDIT
Route::get('/refresh-timing-detail-edit/{id_fbn}', function ($id_fbn) {
    return view('ajax.refresh-timing-detail-edit', compact('id_fbn'));
});

//CUSTOM TABLE
// .        nama link | nama controller  | nama function | nama route
Route::post('addRow', 'PdfController@addRow')->name('addRow');
Route::post('addColumn', 'PdfController@addColumn')->name('addColumn');
Route::post('addData', 'PdfController@addData')->name('addData');

Route::get('deleteColumn', 'PdfController@deleteColumn')->name('deleteColumn');
Route::get('deleteRow', 'PdfController@deleteRow')->name('deleteRow');
Route::get('/refresh-custom-table', function () {
    return view('ajax.refresh-custom-table');
});
//EDIT
Route::get('/refresh-custom-table-edit/{id_fbn}', function ($id_fbn) {
    return view('ajax.refresh-custom-table-edit', compact('id_fbn'));
});
Route::get('/refresh-baris-kolom', function () {
    return view('ajax.refresh-baris-kolom');
});
//EDIT
Route::get('/refresh-baris-kolom-edit/{id_fbn}', function ($id_fbn) {
    return view('ajax.refresh-baris-kolom-edit', compact('id_fbn'));
});

//Kirim Email
Route::post('kirim-email','MailController@kirimEmail')->name('kirimEmail');
Route::get('kirim-email/{id_fbn}','MailController@kirimEmail2')->name('kirimEmail2');

Route::get('/download/{file}','PdfController@download')->name('download');


//POST -> nambah data ke server
//PUT -> edit / ubah
//GET -> untuk nampilin data / hapus data / mengambil data dari database