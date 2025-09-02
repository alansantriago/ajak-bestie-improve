<?php

use App\Http\Controllers\UserAkunController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\DinasController;
use App\Http\Controllers\FaktorController;
use App\Http\Controllers\InfromasiJabatanController;
use App\Http\Controllers\ManajerialController;
use App\Http\Controllers\AnalisisJabatanController;
use App\Http\Controllers\BebanKerjaController;
use App\Http\Controllers\BiodataJabatanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KompetensiJabatanController;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\KompetensiTeknisController;
use App\Http\Controllers\KorelasiJabatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanOPDController;
use App\Http\Controllers\PetaJabatanController;
use App\Http\Controllers\SettingController;
use App\Models\Dinas;
use App\Http\Controllers\VerifikasiController;

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

Route::get('/deploy', [SettingController::class, 'deploy'])->name('deploy');
Route::get('/maintenance/on', [SettingController::class, 'maintenanceOn'])->name('maintenanceOn');
Route::get('/maintenance/off', [SettingController::class, 'maintenanceOff'])->name('maintenanceOff');
Route::get('/artisan/{command}', [SettingController::class, 'artisanCommand'])->name('artisanCommand');

Route::get('/', [FirstController::class, 'index'])->name('beranda');
Route::get('tentang', [FirstController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [FirstController::class, 'kontak'])->name('kontak');
Route::get('login', [FirstController::class, 'login'])->name('login');

// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => ['role:bkd']], function () {
    Route::get('/bkd/laporan-informasi-jabatan', [HomeController::class, 'bkd_informasi_jabatan'])->name('bkd.informasijabatan');
    Route::get('/bkd/laporan-informasi/{kode_jabatan}', [LaporanController::class, 'informasiJabatan'])->name('bkd.laporaninformasi');
    Route::get('/bkd/laporan-rekap', [HomeController::class, 'bkd_indexrekapabk'])->name('bkd.rekapitulasi');
    Route::get('/bkd/cetak-laporan-rekap', [LaporanController::class, 'rekapitulasi'])->name('bkd.cetakrekapitulasi');
    Route::get('/bkd/peta-jabatan', [PetaJabatanController::class, 'index'])->name('bkd.petajabatan');
    Route::get('/bkd/detail_peta/{id}', [PetaJabatanController::class, 'detail'])->name('bkd.detailpetajabatan');
    Route::get('/bkd/cetak-peta/{id}', [PetaJabatanController::class, 'peta'])->name('bkd.cetakpetajabatan');
    Route::get('/bkd/unduh-peta/{id}', [PetaJabatanController::class, 'unduhPetaPdf'])->name('bkd.peta.unduh'); // <-- TAMBAHKAN ROUTE INI
});
Route::group(['middleware' => ['role:pimpinan']], function () {

    Route::get('/pimpinan/laporan-rekap', [HomeController::class, 'pimpinan_indexrekapabk'])->name('pimpinan.rekapitulasi');
    Route::get('/pimpinan/cetak-laporan-rekap', [LaporanController::class, 'rekapitulasi'])->name('pimpinan.cetakrekapitulasi');
});

Route::group(['middleware' => ['auth', 'aktif', 'roleDisable']], function () {
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

    // Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::group(['middleware' => 'role:superadmin'], function () {
        Route::resource('dinas', DinasController::class)->except(['create', 'show', 'edit']);

        Route::get('/dinas/changestatus', [DinasController::class, 'changestatus'])->name('opd.changestatus');
        Route::get('/dinas/changeallstatus', [DinasController::class, 'changeallstatus'])->name('opd.changeallstatus');

        Route::get('/faktor-jabatan', [FaktorController::class, 'index']);
        // Route::get('/faktor-jabatan-struktural', [FaktorController::class, 'indexstruktural']);
        // Route::get('/create-faktor-struktural', [FaktorController::class, 'createstruktural']);
        Route::get('/create-faktor', [FaktorController::class, 'create']);
        Route::post('/insert-faktor', [FaktorController::class, 'store']);
        Route::delete('/faktor-jabatan/{id}', [FaktorController::class, 'destroy']);
        Route::put('/faktor-jabatan/{id}', [FaktorController::class, 'update']);

        Route::get('/manajerial', [ManajerialController::class, 'index']);
        Route::put('/manajerial/{id}', [ManajerialController::class, 'update']);
        Route::post('/manajerial', [ManajerialController::class, 'store']);
        Route::delete('/manajerial/{id}', [ManajerialController::class, 'destroy']);
    });
    Route::group(['middleware' => 'roleSA'], function () {

        Route::get('/users', [UserAkunController::class, 'index']);
        Route::delete('/users/{id}', [UserAkunController::class, 'delete']);
        Route::get('/create-user', [UserAkunController::class, 'create']);
        Route::post('/insert-user', [UserAkunController::class, 'insert']);
        Route::put('/users/{id}', [UserAkunController::class, 'update']);
        Route::get('/users/changestatus', [UserAkunController::class, 'changestatus'])->name('users.changestatus');
        Route::get('/users/changeallstatus', [UserAkunController::class, 'changeallstatus'])->name('users.changeallstatus');

        Route::resource('jabatan', JabatanController::class)->except(['index']);
        Route::get('/jabatan-pelaksana', [JabatanController::class, 'pelaksana'])->name('pelaksana');
        Route::get('/jabatan-fungsional', [JabatanController::class, 'fungsional'])->name('fungsional');
        Route::get('/jabatan-struktural', [JabatanController::class, 'struktural'])->name('struktural');
        Route::get('/tambah-jabatan', [JabatanController::class, 'create']);

        Route::resource('/informasi-faktor', InfromasiJabatanController::class)->except(['create', 'show', 'index', 'store']);
        Route::get('/informasi-faktor-jabatan-struktural', [InfromasiJabatanController::class, 'struktural'])->name('informasi-faktor-struktural');
        Route::get('/informasi-faktor-jabatan-pelaksana', [InfromasiJabatanController::class, 'pelaksana'])->name('informasi-faktor-pelaksana');
        Route::get('/informasi-faktor-jabatan-fungsional', [InfromasiJabatanController::class, 'fungsional'])->name('informasi-faktor-fungsional');
        // Route::get('/informasi-faktor/{id}/edit', [InfromasiJabatanController::class, 'edit'])->name('informasi-faktor-edit');

        Route::get('/standar-kompetensi-jabatan-struktural', [KompetensiJabatanController::class, 'struktural']);
        Route::get('/standar-kompetensi-jabatan-pelaksana', [KompetensiJabatanController::class, 'pelaksana']);
        Route::get('/standar-kompetensi-jabatan-fungsional', [KompetensiJabatanController::class, 'fungsional']);
        Route::resource('/standar-kompetensi', KompetensiJabatanController::class)->except(['create', 'show', 'index', 'store']);

        Route::get('/verifikasi/{kode_jabatan}/{kolom_verifikasi}/{status_verifikasi}', [VerifikasiController::class, 'StatusVerifikasi'])->name('verifikasi');

        Route::get('/export-database', [SettingController::class, 'exportDatabase'])->name('exportDatabase');

        Route::get('/laporan-biodata-seluruh-dinas/{allData?}', [LaporanController::class, 'all_biodata'])->name('all_biodata');
    });

    Route::resource('/analisis_jabatan', AnalisisJabatanController::class)->except(['show', 'create']);
    Route::post('/ambil-data-jabatan', [AnalisisJabatanController::class, 'datajabatan'])->name('datajabatan');
    Route::post('/ambil-code-jabatan', [AnalisisJabatanController::class, 'getcodeparent'])->name('getcodeparent');
    Route::post('/ambil-code-child', [AnalisisJabatanController::class, 'getcodechild'])->name('getcodechild');
    Route::post('/analisis_jabatan_child', [AnalisisJabatanController::class, 'storechild'])->name('storechild');



    Route::resource('/analisis_korelasi', KorelasiJabatanController::class)->except(['show', 'create', 'store']);
    Route::resource('/analisis_beban_kerja', BebanKerjaController::class)->except(['show', 'create', 'store']);
    Route::resource('/analisis_kompetensi_teknis', KompetensiTeknisController::class)->except(['show', 'create', 'store']);
    Route::resource('/biodata_jabatan', BiodataJabatanController::class)->except(['show', 'create', 'store']);
    Route::delete('/biodata_jabatan/{id}/delete_id', [BiodataJabatanController::class, 'destroy_id'])->name('biodata_jabatan.destroy_id');
    Route::group(['middleware' => 'roleSA'], function () {
        Route::get('/biodata_jabatan/{kode_jabatan}/create', [BiodataJabatanController::class, 'create'])->name('biodata_jabatan.create');
        Route::post('/biodata_jabatan/{kode_jabatan}/store', [BiodataJabatanController::class, 'store'])->name('biodata_jabatan.store');
    });


    Route::get('/laporan-informasi/{kode_jabatan}', [LaporanController::class, 'informasiJabatan'])->name('laporaninformasi');
    Route::get('/laporan-faktor/{kode_jabatan}', [LaporanController::class, 'faktorJabatan'])->name('laporanfaktor');
    Route::get('/laporan-kompetensi/{kode_jabatan}', [LaporanController::class, 'standarkompetensi'])->name('laporankompetensi');
    Route::get('/laporan-informasi-jabatan', [LaporanController::class, 'indexinformasijabatan']);
    Route::get('/laporan-faktor-jabatan', [LaporanController::class, 'indexfaktorjabatan'])->name('indexfaktorjabatan');
    Route::get('/laporan-kompetensi-jabatan', [LaporanController::class, 'indexkompetensijabatan'])->name('indexkompetensijabatan');
    // Route::get('/peta-jabatan', [PetaJabatanController::class, 'index']);
    // Route::get('/detail_peta/{id}', [PetaJabatanController::class, 'detail']);
    Route::get('/laporan-rekap', [LaporanController::class, 'indexrekapabk']);
    Route::get('/cetak-laporan-rekap', [LaporanController::class, 'rekapitulasi']);
    Route::get('/laporan-biodata', [LaporanController::class, 'indexrekapbiodatajabatan']);
    Route::get('/detail_rekap_biodata/{id}', [LaporanController::class, 'detailrekapbiodata']);
    Route::get('/cetak-laporan-biodata/{id}/{allData?}', [LaporanController::class, 'biodata'])->name('cetak_biodata');

    Route::get('/peta-jabatan', [PetaJabatanController::class, 'index']);
    Route::get('/detail_peta/{id}', [PetaJabatanController::class, 'detail']);
    Route::get('/cetak-peta/{id}', [PetaJabatanController::class, 'peta']);
    Route::get('/unduh-peta/{id}', [PetaJabatanController::class, 'unduhPetaPdf'])->name('peta.unduh'); // <-- TAMBAHKAN ROUTE INI

    Route::get('/laporan-faktor-dinas/{dinas_id}', [LaporanOPDController::class, 'faktorJabatan'])->name('laporanfaktoropd');
    Route::get('/laporan-kompetensi-dinas/{dinas_id}', [LaporanOPDController::class, 'standarkompetensi'])->name('laporankompetensiopd');
    // Route::get('/laporan-faktor-seluruh-dinas', [LaporanOPDController::class, 'faktorJabatanAll'])->name('laporanfaktorseluruhopd');


    Route::get('/buka-verifikasi/{kode_jabatan}/{kolom_verifikasi}', [VerifikasiController::class, 'BukaStatusVerifikasi'])->name('buka-verifikasi');
});

