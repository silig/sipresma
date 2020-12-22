<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Departemen;


class DanaSisa {

    //Untuk Fakultas
    public static function dana($jenis,$dept,$tahun) {
    	
    	if($dept == 99){
    		$departemen = 'Fakultas';
    	}else{
    		$deknen = Departemen::find($dept);
    		$departemen = $deknen->nama_departemen;
    	}

    	
      	$dana = DB::Select(DB::raw("SELECT b.jumlah FROM dana a join danadetail b on a.id = b.id_dana where tahun = ".$tahun." and departemen = '".$departemen."' and b.jenis = '".$jenis."' "));
      	if(isset($dana[0]->jumlah)){
      		$hasil = $dana[0]->jumlah;
      	}else if(!isset($dana[0]->jumlah)){
      		$hasil = null;
      	}
      	//$jumlahdana = DB::select(DB::raw("select sum(danadisetujui) susu from proposal where sumberdana = 1 and created_at like '%".$tahun."%' "));
      	
       return $hasil;
    }

    public static function sisa($jenis,$dept,$tahun){
      
    	if($dept == 99){
            $departemen = 'Fakultas';
        }else{
            $deknen = Departemen::find($dept);
            $departemen = $deknen->nama_departemen;
        }

        $dana = DB::Select(DB::raw("SELECT b.jumlah FROM dana a join danadetail b on a.id = b.id_dana where tahun = ".$tahun." and departemen = '".$departemen."' and b.jenis = '".$jenis."' "));
        if(isset($dana[0]->jumlah)){
            $hasil = $dana[0]->jumlah;
        }else if(!isset($dana[0]->jumlah)){
            $hasil = null;
        }

        $terpakai= DB::select(DB::raw("select sum(danadisetujui) jumlah from proposal where created_at like '%".$tahun."%' and departemen =".$dept." and SUBSTRING(nomor_proposal,1,2) = '".$jenis."' and status = 1 "));
        
        $sisaduit = $hasil - $terpakai[0]->jumlah;


        
        return $sisaduit;

    }
}