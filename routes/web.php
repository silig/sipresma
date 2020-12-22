<?php

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
Route::get('/', function() {
    return redirect(route('login'));
});

Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    
    route::get('/idle' , 'Lockscreen@index')->name('idle');

   // Role ADMIN 
    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('/role', 'RoleController')->except([
            'create', 'show', 'edit', 'update'
        ]);
        Route::resource('/users', 'UserController')->except([
            'show'
        ]);
        Route::get('/users/roles/{id}', 'UserController@roles')->name('users.roles');
        Route::put('/users/roles/{id}', 'UserController@setRole')->name('users.set_role');
        Route::post('/users/permission', 'UserController@addPermission')->name('users.add_permission');
        Route::get('/users/role-permission', 'UserController@rolePermission')->name('users.roles_permission');
        Route::put('/users/permission/{role}', 'UserController@setRolePermission')->name('users.setRolePermission');
        route::get('/users/aktifkan/{id}', 'UserController@setAktif')->name('users.aktif');
        route::get('/users/nonaktifkan/{id}', 'UserController@setNonAktif')->name('users.nonaktif');

        route::get('/laporan', 'LaporanController@index')->name('laporan');
        route::post('/laporan/hasil', 'LaporanController@hasil')->name('laporan.hasil');

        
        route::post('/mahasiswa/import', 'MahasiswaController@import')->name('import');
        route::get('/mahasiswa/cari', 'MahasiswaController@cari')->name('mahasiswa.cari');
        route::post('/mahasiswa/add', 'MahasiswaController@add')->name('mahasiswa.add');
        route::post('/mahasiswa/update/{id}', 'MahasiswaController@update')->name('mahasiswa.update');
        route::get('/mahasiswa', 'MahasiswaController@index')->name('mahasiswa.index');

        route::get('/formsetting', 'formsettingController@index')->name('formsetting');
        route::put('/formsetting/update/{i}', 'formsettingController@update')->name('formsetting.update');
        route::get('/mahasiswa/getdata', 'MahasiswaController@getData')->name('mahasiswa.getdata');
        route::post('/mahasiswa/getjur', 'MahasiswaController@getjurusan')->name('get.jur');

        Route::get('/usermhs','UserController@searchmhs')->name('searchmhs');
        // route::get('/report/delegasi', 'ReportController@delegasi')->name('report.delegasi');
        // route::post('/report/delegasi/hasil', 'ReportController@report')->name('report.delegasi.hasil');


        
    });


    Route::group(['middleware' => ['role:senat']], function () {
      
        route::get('/senat/masuk', 'SenatController@proposalbaru')->name('senat.proposalbaru');
        route::get('/senat/proposaldisetujui', 'SenatController@proposaldisetujui')->name('senat.proposaldisetujui');
        route::get('/senat/proposalditolak', 'SenatController@proposalditolak')->name('senat.proposalditolak');
        route::get('/senat/lpj', 'SenatController@lpjmasuk')->name('senat.lpj');
        route::get('/senat/lpjselesai', 'SenatController@lpjdisetujui')->name('senat.lpjselesai');
    });
    
        // Route::resource('/kategori', 'CategoryController')->except([
        //     'create', 'show'
        // ]);
         // Route::resource('/produk', 'ProductController');
   

    //Halaman yang diakses oleh mahasiswa
    Route::group(['middleware' => ['role:mahasiswa|admin']], function() {
            route::get('/pengajuanku/delegasi', 'PengajuankuController@delegasi')->name('pengajuanku.delegasi');
            // route::get('/pengajuanku/delegasi/detail/{id}', 'PengajuankuController@delegasidetail')->name('pengajuanku.delegasi.detail');
            // route::get('/pengajuanku/delegasi/edit/{id}', 'PengajuankuController@delegasiedit')->name('pengajuanku.delegasi.edit');
            route::get('/pengajuanku/penyelenggara', 'PengajuankuController@penyelenggara')->name('pengajuanku.penyelenggara');
            route::get('/prestasi', 'PrestasiController@index')->name('prestasi.index');
            route::get('/prestasi/export/mhs', 'PrestasiController@laporan')->name('export.prestasi');
            // route::post('/prestasi/export/mhsi', 'ReportController@export')->name('report.prestasi');
            route::get('/proposal/dp', 'DaftarProposaldisetujuiController@lpjmasukdepartemen')->name('dps.dept');
            route::get('/proposal/fk', 'DaftarProposaldisetujuiController@lpjmasukfakultas')->name('dps.fak');
            route::get('/lpj/delegasi/{id}', 'lpjController@delegasi')->name('lpj.delegasi');
            route::post('/lpj/delegasi/update/{id}', 'lpjController@update')->name('lpj.update');
            route::get('/lpj/penyelenggara/{id}', 'lpjController@penyelenggara')->name('lpj.penyelenggara');
    });

    //HALAMAN ADMIN  DAN DEPARTEMEN
    Route::group(['middleware' => ['role:admin|departemen']], function() {
            
            route::get('/daftarmasuk/departemen', 'PengajuanMasukController@departemen')->name('DaftarMasuk.departemen');
            route::get('/aturdana/departemen', 'PengajuanMasukController@danadepartemen')->name('aturdana.departemen');
            route::get('/proposaldisetujui/departemen', 'PengajuanMasukController@proposaldisetujuidepartemen')->name('proposaldisetujui.departemen');
            route::get('/proposalditolak/departemen', 'PengajuanMasukController@proposalditolakdepartemen')->name('proposalditolak.departemen');
            route::get('/lpjmasuk/departemen', 'PengajuanMasukController@lpjmasukdepartemen')->name('lpjmasuk.departemen');
            route::get('/lpjdisetujui/departemen', 'PengajuanMasukController@lpjdisetujuidepartemen')->name('lpjdisetujui.departemen');
           route::get('/lpjditolak/departemen', 'PengajuanMasukController@lpjditolakdepartemen')->name('lpjditolak.departemen');
    });
    //HALAMAN FAKULTAS
    Route::group(['middleware' => ['role:fakultas']], function() {
        route::get('/daftarmasuk/fakultas', 'PengajuanMasukController@fakultas')->name('DaftarMasuk.fakultas');
        route::get('/aturdana/fakultas', 'PengajuanMasukController@danafakultas')->name('aturdana.fakultas');
        route::get('/proposaldisetujui/fakultas', 'PengajuanMasukController@proposaldisetujuifakultas')->name('proposaldisetujui.fakultas');
        route::get('/proposalditolak/fakultas', 'PengajuanMasukController@proposalditolakfakultas')->name('proposalditolak.fakultas');
        route::get('/lpjmasuk/fakultas', 'PengajuanMasukController@lpjmasukfakultas')->name('lpjmasuk.fakultas');
        route::get('/lpjdisetujui/fakultas', 'PengajuanMasukController@lpjdisetujuifakultas')->name('lpjdisetujui.fakultas');
        route::get('/lpjditolak/fakultas', 'PengajuanMasukController@lpjditolakfakultas')->name('lpjditolak.fakultas');
    });

    Route::get('/home', 'HomeController@index')->name('home');
    route::get('/gantipassword/{id}', 'UserController@gantipassword')->name('gantipassword');
    route::post('/gantipassword/{id}', 'UserController@updatepassword')->name('updatepassword');

    //ACTION UNTUK DEPARTEMEN DAN FAKULTAS
    Route::group(['middleware' => ['role:fakultas|departemen']], function() {
        route::put('/daftarmasuk/approve/{id}', 'PengajuanMasukController@approve')->name('DaftarMasuk.approve');
        route::put('/daftarmasuk/tolak/{id}', 'PengajuanMasukController@tolak')->name('DaftarMasuk.tolak');
        route::post('/aturdana/tambahdana', 'PengajuanMasukController@tambahdana')->name('aturdana.tambahdana');
        route::get('/daftarlpj/approvelpj/{id}', 'PengajuanMasukController@approvelpj')->name('Daftarlpj.approve');
        
        
    });

     //ROLE ADMIN, DEPARTEMEN ,FAKULTAS
    Route::group(['middleware' => ['role:admin|departemen|fakultas|senat']], function() {
        //laporan
        route::get('/laporan', 'LaporanController@index')->name('laporan');
        route::post('/laporan/hasil', 'LaporanController@hasil')->name('laporan.hasil');

        //report delegasi
        route::get('/report/delegasi', 'ReportController@delegasi')->name('report.delegasi');
        route::post('/report/delegasi/hasil', 'ReportController@report')->name('report.delegasi.hasil');

        route::get('/report/penyelenggara', 'ReportController@penyelenggara')->name('report.penyelenggara');
        route::post('/report/penyelenggara/hasil', 'ReportController@reportpenyelenggara')->name('report.penyelenggara.hasil');
        route::post('/report/export/mhsi', 'ReportController@export')->name('report.prestasi');
        //Manajemen Dana
        Route::resource('/dana', 'DanaController');
        route::get('/dana', 'DanaController@index')->name('dana.index');
        Route::get('/dana/hapus/{id}' , 'DanaController@hapus')->name('dana.hapus');
        Route::get('/dana/detail/{id}' , 'DanaController@detail')->name('dana.detail');
        Route::post('/dana/adddetail/{id}' , 'DanaController@adddetail')->name('dana.adddetail');
        Route::get('/dana/hapusdetail/{id}' , 'DanaController@hapusdetail')->name('dana.hapusdetail');

        //manajemen departemen
        route::get('/manajemen/dept', 'DepartemenController@index')->name('departemen.index');
        route::put('/manajemen/dept/update/{id}', 'DepartemenController@update')->name('departemen.update');

        //hapus proposal
        route::get('/hapus/proposal/{id}', 'ProposalDelegasiController@hapus')->name('hapus_proposal');
        route::get('/editdelegasi/proposal/{id}', 'ProposalDelegasiController@editAdm')->name('edit_proposal');
        route::post('/updatedelegasi/proposal/{id}', 'ProposalDelegasiController@updateAdm')->name('update_proposal');
        //edit penyelenggara
        route::get('/editpenyelenggara/proposal/{id}', 'ProposalPenyelenggaraController@editAdm')->name('edit_proposal1');
        route::post('/updatepenyelenggara/proposal/{id}', 'ProposalPenyelenggaraController@updateAdm')->name('update_proposal1');
    });

    //Pengajuan Delegasi
    Route::get('/proposal/delegasi', 'ProposalDelegasiController@index')->name('delegasi');
    Route::get('/proposal/delegasi/create', 'ProposalDelegasiController@create')->name('delegasi.create');
    Route::post('/proposal/delegasi/simpan', 'ProposalDelegasiController@store')->name('delegasi.simpan');
    Route::get('/proposal/delegasi/edit/{id}', 'ProposalDelegasiController@edit')->name('delegasi.edit');
    Route::post('/proposal/delegasi/update/{id}', 'ProposalDelegasiController@update')->name('delegasi.update');
    Route::post('/proposal/delegasi/addanggota/{id}', 'ProposalDelegasiController@addAnggota')->name('delegasi.addAnggota');
    Route::delete('/proposal/delegasi/hapusanggota/{id}', 'ProposalDelegasiController@hapusAnggota')->name('delegasi.hapusAnggota');
    route::get('/proposal/delegasi/detail/{id}', 'ProposalDelegasiController@lihatDetail')->name('delegasi.detail');
    route::get('/proposal/delegasi/cari', 'ProposalDelegasiController@cari')->name('delegasi.cari');

    //Pengajuan Penyelenggara
    Route::get('/proposal/penyelenggara', 'ProposalPenyelenggaraController@index')->name('penyelenggara');
    Route::get('/proposal/penyelenggara/create', 'ProposalPenyelenggaraController@create')->name('penyelenggara.create');
    Route::post('/proposal/penyelenggara/simpan', 'ProposalPenyelenggaraController@store')->name('penyelenggara.simpan');
    Route::get('/proposal/penyelenggara/edit/{id}', 'ProposalPenyelenggaraController@edit')->name('penyelenggara.edit');
    Route::put('/proposal/penyelenggara/update/{id}', 'ProposalPenyelenggaraController@update')->name('penyelenggara.update');
    Route::post('/proposal/penyelenggara/addanggota/{id}', 'ProposalpenyelenggaraController@addAnggota')->name('penyelenggara.addAnggota');
    Route::delete('/proposal/penyelenggara/hapusanggota/{id}', 'ProposalPenyelenggaraController@hapusAnggota')->name('penyelenggara.hapusAnggota');
    route::get('/proposal/penyelenggara/detail/{id}', 'ProposalPenyelenggaraController@lihatDetail')->name('penyelenggara.detail');
    route::get('/proposal/penyelenggara/cari', 'ProposalPenyelenggaraController@cari')->name('penyelenggara.cari');
    
    //Route::get('/dana', 'DanaController@index');
    //Route::post('/dana/store', 'DanaController@store')->name('dana.store');

    route::get('/cetak/{id}', 'GenerateController@pengesahan')->name('cetak');
    route::get('/cetak/st/{id}', 'GenerateController@surattugas')->name('cetak.st');

    route::get('/mahasiswa/ambil', 'MahasiswaController@lookup')->name('ambil');

   


});



Route::get('reset', function (){
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');

    echo 'telah direset';
});









