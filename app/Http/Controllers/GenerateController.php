<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use App\Proposal;
use Tanggal;
use App\formcetak;

class GenerateController extends Controller
{
    public function pengesahan($di){
    	$id = decrypt($di);
    	$proposal = Proposal::findorFail($id);
		$tglmulai = Tanggal::indo($proposal->tglmulai);

    	$tglselesai = Tanggal::indo($proposal->tglselesai);

		$tglpengajuan = Tanggal::indo($proposal->created_at);
        $formcetak = formcetak::where('jabatan', 'Wadek I')->first();
		
        if(substr($proposal->nomor_proposal,0, 1)== 'D'){
    	       $ketua= DB::select(DB::raw
                   ("SELECT a.id,a.id_proposal , NIM, Nama, jabatan, nama_departemen,kadep,nip  FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal=".$id." and a.jabatan = 'ketua'" ));
        }
        else if (substr($proposal->nomor_proposal,0, 1)== 'P'){
                $ketua= DB::select(DB::raw
                   ("SELECT a.id,a.id_proposal , NIM, Nama, jabatan, nama_departemen,kadep,nip  FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal=".$id." and a.jabatan = 'bendahara'" ));
        }
    	dd($ketua);
		$pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
		        ->loadView('cetak.pengesahan',compact('proposal','tglmulai','tglselesai','tglpengajuan','ketua','formcetak'));
		
    	return $pdf->stream();
    }

    public function surattugas($di){
        $id = decrypt($di);
        $proposal = Proposal::findorFail($id);
        $tglmulai = Tanggal::indo($proposal->tglmulai);
        $tglselesai = Tanggal::indo($proposal->tglselesai);
        $formcetak = formcetak::where('jabatan', 'KTU')->first();
        $anggota= DB::select(DB::raw
                   ("SELECT a.id,NIM, Nama, jabatan, nama_departemen,kadep,nip  FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal=".$id." " ));

        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
                ->loadView('cetak.surattugas',compact('proposal','tglmulai','tglselesai','tglpengajuan','anggota','formcetak'));
        
        return $pdf->stream();
        //return $pdf->download('carfact_sheet.pdf');
    }

}
