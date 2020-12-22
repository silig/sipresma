<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Proposal;
use UserHelp;
use DB;

class penyelenggara implements FromView, ShouldAutoSize
{

	use Exportable;
	protected $penyelenggara;
    protected $tahun;
    protected $penyelenggara_kegiatan;
    protected $unit;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($tahun, $penyelenggara_kegiatan, $unit)
    {
    	
        $this->tahun = $tahun;
        $this->penyelenggara_kegiatan = $penyelenggara_kegiatan; 
        $this->unit = $unit; 
    }
    public function view(): View
    {
    	$tahun  = $this->tahun;
    	$penyelenggara_kegiatan  = $this->penyelenggara_kegiatan;
    	$unit  = $this->unit;
    	$req1 = null;

    	if($penyelenggara_kegiatan == 'UPK' || $penyelenggara_kegiatan == 'Himpunan'){
    			if($unit=='semua'){
    				$data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                        join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$tahun."%' and penyelenggara_kegiatan = '".$penyelenggara_kegiatan."' "));

                    return view('report.hasil3', compact('data','req1'));
    			}else{
    				$data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                        join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$tahun."%' and penyelenggara_kegiatan = '".$penyelenggara_kegiatan."' and unit_kegiatan='".$unit."' "));

                    return view('report.hasil3', compact('data','req1'));
    			}
    	} elseif($penyelenggara_kegiatan == 'semua'){
    		$data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                    join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$tahun."%' "));

            return view('report.hasil3', compact('data','req1'));
    	}else{
    		$data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                    join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$tahun."%' and penyelenggara_kegiatan = '".$penyelenggara_kegiatan."' "));

            return view('report.hasil3', compact('data','req1'));
    	}
    }
}
