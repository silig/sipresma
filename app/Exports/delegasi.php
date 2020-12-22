<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Proposal;
use UserHelp;
use DB;

class delegasi implements FromView, ShouldAutoSize
{

	use Exportable;
	protected $delegasi;
    protected $tahun;
    protected $jenis;
    protected $tingkat;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($tahun, $jenis, $tingkat)
    {
    	
        $this->tahun = $tahun;
        $this->jenis = $jenis; 
        $this->tingkat = $tingkat; 
    }
    public function view(): View
    {
    	$tahun  = $this->tahun;
    	$jenis  = $this->jenis;
    	$tingkat  = $this->tingkat;
    	$request = null;
    	if($jenis == 'semua'){
    			if($tingkat == 'semua'){
    				//isinya disini
    				$data = DB::select(DB::raw("select a.nomor_proposal,a.nohp,a.id,a.nama_kegiatan,a.tingkat,a.lokasi_kegiatan,a.tglmulai,a.tglselesai,b.url, b.capaian,a.status statuspro, b.status statuslpj from proposal a
    					join lpj b on a.id=b.id_proposal where jenis_proposal = 'delegasi' and a.created_at like '%".$tahun."%'"));
    				
    				return view('report.hasil', compact('data','request'));
    			} elseif ($tingkat == 'internasional'){
    				//isinya disini
    				$data = DB::select(DB::raw("select a.nomor_proposal,a.nohp,a.id,a.nama_kegiatan,a.tingkat,a.lokasi_kegiatan,a.tglmulai,a.tglselesai,b.url, b.capaian,a.status statuspro, b.status statuslpj from proposal a
    					join lpj b on a.id=b.id_proposal where jenis_proposal = 'delegasi' and tingkat = 'internasional' and a.created_at like '%".$tahun."%' "));

    				return view('report.hasil', compact('data','request'));
    			} else {
    				$data = DB::select(DB::raw("select a.nomor_proposal,a.nohp,a.id,a.nama_kegiatan,a.tingkat,a.lokasi_kegiatan,a.tglmulai,a.tglselesai,b.url, b.capaian,a.status statuspro, b.status statuslpj from proposal a
    					join lpj b on a.id=b.id_proposal where jenis_proposal = 'delegasi' and tingkat IN ('nasional','regional') and a.created_at like '%".$tahun."%' "));

    				return view('report.hasil', compact('data','request'));
    			}
    		}
    		//ketika memilih
    	else{
    			if($tingkat == 'semua'){
    				//isinya disini
    				$data = DB::select(DB::raw("select a.nomor_proposal,a.nohp,a.id,a.nama_kegiatan,a.tingkat,a.lokasi_kegiatan,a.tglmulai,a.tglselesai,b.url, b.capaian,a.status statuspro, b.status statuslpj from proposal a
    					join lpj b on a.id=b.id_proposal where jenis_proposal = 'delegasi' and a.created_at like '%".$tahun."%' and jenis_kegiatan= '".$jenis."' "));

    			} elseif ($tingkat == 'internasional'){
    				//isinya disini
    				$data = DB::select(DB::raw("select a.nomor_proposal,a.nohp,a.id,a.nama_kegiatan,a.tingkat,a.lokasi_kegiatan,a.tglmulai,a.tglselesai,b.url, b.capaian,a.status statuspro, b.status statuslpj from proposal a
    					join lpj b on a.id=b.id_proposal where jenis_proposal = 'delegasi' and tingkat = 'internasional' and a.created_at like '%".$tahun."%' and jenis_kegiatan= '".$jenis."' "));

    				return view('report.hasil', compact('data','request'));
    			} else {
    				$data = DB::select(DB::raw("select a.nomor_proposal,a.nohp,a.id,a.nama_kegiatan,a.tingkat,a.lokasi_kegiatan,a.tglmulai,a.tglselesai,b.url, b.capaian,a.status statuspro, b.status statuslpj from proposal a
    					join lpj b on a.id=b.id_proposal where jenis_proposal = 'delegasi' and tingkat IN ('nasional','regional') and a.created_at like '%".$tahun."%' and jenis_kegiatan= '".$jenis."' "));

    				return view('report.hasil', compact('data','request'));
    			}
    		}
    }
}
