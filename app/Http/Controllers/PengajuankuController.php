<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use UserHelp;
use App\Proposal;
use App\Anggota_proposal;
use App\Departemen;
use File;
use Storage;
use App\Mahasiswa;
use DateTime;
use Carbon\Carbon;
use ViewPDF;

class PengajuankuController extends Controller
{
    public function delegasi()
    {
    	$nim = UserHelp::datauser()[0]->NIM;
    	$data = DB::Select(DB::raw(
    		"select a.id, a.nomor_proposal ,a.departemen,a.nama_kegiatan,a.tglmulai,a.tglselesai,a.url,a.tingkat,
            a.ajuandana,a.status,
            c.status as statuslpj from proposal a 
             left join anggota_proposal b on a.id = b.id_proposal
             left join lpj c on a.id = c.id_proposal
    		where b.NIM = '".$nim."' and a.jenis_proposal = 'delegasi' 
            GROUP BY a.id,a.nomor_proposal,a.departemen,a.nama_kegiatan,a.tglmulai,a.tglselesai,a.url,a.ajuandana,a.status,c.status,a.tingkat "));
        
    	$departemen = Departemen::orderBy('id', 'ASC')->get();
    	    	return view('pengajuanku.delegasi.index',compact(['data','departemen']));
    }

    // public function delegasiedit($id)
    // {
    //     $di = decrypt($id);
    //     $data =  Proposal::find($di);
    //    // $anggota = Anggota_proposal::where('id_proposal',$id)->orderBy('jabatan', 'desc')->get();
    //     $anggota= DB::select(DB::raw
    //                ("SELECT a.id,NIM, Nama, jabatan, nama_departemen FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal=".$di." " ));
    //     //dd($anggota);
    //     $departemen = Departemen::orderBy('id', 'ASC')->get();
    //     return view ('pengajuanku.delegasi.edit', compact('data','anggota','departemen'));
    //     // return redirect(route('delegasi.edit', encrypt($proposal->id)));
    // }

    // public function delegasiDetail($id)
    // {
    //     $di = decrypt($id);
    //     $data =  Proposal::find($di);
    //     $anggota= DB::select(DB::raw
    //                ("SELECT a.id,NIM, Nama, jabatan, nama_departemen FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal=".$di." " ));
    //     $ketua= DB::select(DB::raw
    //                ("SELECT a.id,NIM, Nama, jabatan, nama_departemen FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal=".$di." and a.jabatan = 'Ketua' " ));
        
    //     return view('pengajuanku.delegasi.detail', compact('data','anggota','ketua'));
    // }

     public function penyelenggara()
    {
        $nim = UserHelp::datauser()[0]->NIM;
        $data = DB::Select(DB::raw(
            "select a.*,c.status statuslpj from proposal a
            left join anggota_proposal b on a.id = b.id_proposal
            left join lpj c on a.id = c.id_proposal
            where b.NIM = '".$nim."' and a.jenis_proposal = 'penyelenggara' "));
        
        $departemen = Departemen::orderBy('id', 'ASC')->get();
        return view('pengajuanku.penyelenggara.index',compact(['data','departemen']));
    }
}
