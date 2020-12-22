<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Proposal;
use UserHelp;
use DB;

class testing implements FromView, ShouldAutoSize
{

	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $nim = UserHelp::datauser()[0]->NIM;
    	$proposal = DB::Select(DB::raw(
    		"select a.nama_kegiatan, a.nomor_proposal, SUBSTRING(a.created_at,1,4) tahun, c.capaian from proposal a 
             left join anggota_proposal b on a.id = b.id_proposal
             left join lpj c on a.id = c.id_proposal
    		where b.NIM = '".$nim."' and a.status = 1 and c.status =1 " 
            ));
        
    	return view('export.prestasi', ['proposal' => $proposal]);
    }
}
