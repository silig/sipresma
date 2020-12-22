<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use UserHelp;
use App\Departemen;
use Excel;
use App\Exports\testing;
use App\Exports\UserExport;

class PrestasiController extends Controller
{
    public function index(){

    	$nim = UserHelp::datauser()[0]->NIM;
    	$data = DB::Select(DB::raw(
    		"select a.id, a.nomor_proposal ,a.departemen,a.nama_kegiatan,a.tglmulai,a.tglselesai,a.url,a.tingkat,
            a.danadisetujui,a.status,
            c.status as statuslpj from proposal a 
             left join anggota_proposal b on a.id = b.id_proposal
             left join lpj c on a.id = c.id_proposal
    		where b.NIM = '".$nim."' and a.status = 1 and c.status =1 " 
            ));
        
    	$departemen = Departemen::orderBy('id', 'ASC')->get();
    	return view('prestasi.index',compact('data','departemen'));
    }

    public function laporan(){

    	//return Excel::download(new UserExport, 'prestasi.xlsx');
    	 //return Excel::download(new testing, 'user.xlsx');
    	return (new testing)->download('prestasiku.xlsx');
    }
    
    // public function haha(){
    	
    //     $nim = UserHelp::datauser()[0]->NIM;
    // 	$proposal = DB::Select(DB::raw(
    // 		"select a.*,b.*,c.* from proposal a 
    //          left join anggota_proposal b on a.id = b.id_proposal
    //          left join lpj c on a.id = c.id_proposal
    // 		where b.NIM = '".$nim."' and a.status = 1 and c.status =1 " 
    //         ));


    // 	return view('export.prestasi', ['proposal' => $proposal]);
    
    // }
}
