<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use UserHelp;
use DB;

class DaftarProposalDisetujuiController extends Controller
{
    public function lpjmasukdepartemen(){
        $departemen = UserHelp::datauser()->id_departemen;
        $lpj = DB::select(DB::raw("select a.id, a.created_at, a.nomor_proposal,a.jenis_proposal, a.nama_kegiatan,a.bentuk_kegiatan,a.tglmulai,a.tglselesai,b.status,a.danadisetujui from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 2 and departemen ='".$departemen."' order by created_at desc"));
        

        return view('pengajuanmasuk.daftarpropsaldisetujui', compact('lpj'));
    }

    public function lpjmasukfakultas(){
        //$departemen = UserHelp::datauser()->id_departemen;
        $lpj = DB::select(DB::raw("select a.id, a.created_at, a.nomor_proposal,a.jenis_proposal, a.nama_kegiatan,a.bentuk_kegiatan,a.tglmulai,a.tglselesai,b.status,a.danadisetujui from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 1 and departemen = 99 order by created_at desc"));
        

        return view('pengajuanmasuk.daftarpropsaldisetujui', compact('lpj'));
    }

}
