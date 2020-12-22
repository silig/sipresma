<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Auth;
use App\LPJ;


class CekLengkap {

    public static function penyelenggara($id) {
    	
      	$lpj = LPJ::where('id_proposal', $id)->first();
		
		if(!isset($lpj)){
             $lengkap = false;
             $danacair = 0;
        }else if(isset($lpj)){
            if(substr($lpj->nomorproposal,0,2) == 'PU' || substr($lpj->nomorproposal,0,2) == 'PS')
            {
                
                if(isset($lpj->nomorproposal) && isset($lpj->terlaksana) && isset($lpj->jumlahpeserta_kegiatan) && isset($lpj->file_dokumentasi) && isset($lpj->file_reportase) && isset($lpj->file_lpj))
                {
                    $lengkap = true;
                    //$danacair = $lpj->status;
                }
                if(!isset($lpj->nomorproposal) || !isset($lpj->terlaksana) || !isset($lpj->jumlahpeserta_kegiatan) || !isset($lpj->file_dokumentasi) || !isset($lpj->file_reportase) || !isset($lpj->file_lpj))
                {
                    $lengkap = false;
                    //$danacair = $lpj->status;
                }
            }
            if(substr($lpj->nomorproposal,0,2) == 'PL')
            {
                
                if(isset($lpj->nomorproposal) && isset($lpj->terlaksana) && isset($lpj->jmlnegara_peserta_lomba) && isset($lpj->jmluniv_peserta_lomba) && isset($lpj->jmlmahasiswa_peserta_lomba) && isset($lpj->file_dokumentasi) && isset($lpj->file_daftar_pemenang) && isset($lpj->file_reportase) && isset($lpj->file_lpj))
                {
                    $lengkap = true;
                    //$danacair = $lpj->status;
                }
                if(!isset($lpj->nomorproposal) || !isset($lpj->terlaksana) || !isset($lpj->jmlnegara_peserta_lomba) || !isset($lpj->jmluniv_peserta_lomba) || !isset($lpj->jmlmahasiswa_peserta_lomba) || !isset($lpj->file_dokumentasi) || !isset($lpj->file_daftar_pemenang) || !isset($lpj->file_reportase) || !isset($lpj->file_lpj))
                {
                   $lengkap = false;
                   //$danacair = $lpj->status;
                }
            }
        }
		 
		return $lengkap;
    }

    public static function delegasi($id) {
    	
      	$lpj = LPJ::where('id_proposal', $id)->first();
		
		if(!isset($lpj)){
             $lengkap = false;
             $danacair = 0;
        }else if(isset($lpj)){
            if(substr($lpj->nomorproposal,0,2) == 'DL' || substr($lpj->nomorproposal,0,2) == 'DN')
                    {
                        
                        if(!isset($lpj->nomorproposal) || !isset($lpj->terlaksana) || !isset($lpj->capaian) || !isset($lpj->file_dokumentasi) || !isset($lpj->file_surat_tugas) || !isset($lpj->file_sertifikat) || !isset($lpj->file_reportase) || !isset($lpj->file_lpj)) 
                        {
                           $lengkap = false;
                           //$danacair = $lpj->status;
                        }
                        if(isset($lpj->nomorproposal) && isset($lpj->terlaksana) && isset($lpj->capaian) && isset($lpj->file_dokumentasi) && isset($lpj->file_surat_tugas) && isset($lpj->file_sertifikat) && isset($lpj->file_reportase) && isset($lpj->file_lpj)) 
                        {
                           $lengkap = true;
                         //  $danacair = $lpj->status;
                        }
                    }
        }
		 
		return $lengkap;
    }

    //digunakan di homeController untuk modal popup
    public static function cek($id) {
      $lpj = LPJ::where('id_proposal', $id)->first();

      if(!isset($lpj)){
             $lengkap = false;
             $danacair = 0;
        }else if(isset($lpj)){
            if(substr($lpj->nomorproposal,0,2) == 'PU' || substr($lpj->nomorproposal,0,2) == 'PS')
            {
                
                if(isset($lpj->nomorproposal) && isset($lpj->terlaksana) && isset($lpj->jumlahpeserta_kegiatan) && isset($lpj->file_dokumentasi) && isset($lpj->file_reportase) && isset($lpj->file_lpj))
                {
                    $lengkap = true;
                    //$danacair = $lpj->status;
                }
                if(!isset($lpj->nomorproposal) || !isset($lpj->terlaksana) || !isset($lpj->jumlahpeserta_kegiatan) || !isset($lpj->file_dokumentasi) || !isset($lpj->file_reportase) || !isset($lpj->file_lpj))
                {
                    $lengkap = false;
                    //$danacair = $lpj->status;
                }
            }
            if(substr($lpj->nomorproposal,0,2) == 'PL')
            {
                
                if(isset($lpj->nomorproposal) && isset($lpj->terlaksana) && isset($lpj->jmlnegara_peserta_lomba) && isset($lpj->jmluniv_peserta_lomba) && isset($lpj->jmlmahasiswa_peserta_lomba) && isset($lpj->file_dokumentasi) && isset($lpj->file_daftar_pemenang) && isset($lpj->file_reportase) && isset($lpj->file_lpj))
                {
                    $lengkap = true;
                    //$danacair = $lpj->status;
                }
                if(!isset($lpj->nomorproposal) || !isset($lpj->terlaksana) || !isset($lpj->jmlnegara_peserta_lomba) || !isset($lpj->jmluniv_peserta_lomba) || !isset($lpj->jmlmahasiswa_peserta_lomba) || !isset($lpj->file_dokumentasi) || !isset($lpj->file_daftar_pemenang) || !isset($lpj->file_reportase) || !isset($lpj->file_lpj))
                {
                   $lengkap = false;
                   //$danacair = $lpj->status;
                }
            }
            if(substr($lpj->nomorproposal,0,2) == 'DL' || substr($lpj->nomorproposal,0,2) == 'DN')
                    {
                        
                        if(!isset($lpj->nomorproposal) || !isset($lpj->terlaksana) || !isset($lpj->capaian) || !isset($lpj->file_dokumentasi) || !isset($lpj->file_surat_tugas) || !isset($lpj->file_sertifikat) || !isset($lpj->file_reportase) || !isset($lpj->file_lpj)) 
                        {
                           $lengkap = false;
                           //$danacair = $lpj->status;
                        }
                        if(isset($lpj->nomorproposal) && isset($lpj->terlaksana) && isset($lpj->capaian) && isset($lpj->file_dokumentasi) && isset($lpj->file_surat_tugas) && isset($lpj->file_sertifikat) && isset($lpj->file_reportase) && isset($lpj->file_lpj)) 
                        {
                           $lengkap = true;
                         //  $danacair = $lpj->status;
                        }
                    }
        }

      return $lengkap;
    }

    
}



