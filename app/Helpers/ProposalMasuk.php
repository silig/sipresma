<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Auth;
use CekLengkap;

class ProposalMasuk {

    //jumlah proposal delegasi
    public static function delegasi()
    {
    	$t = DB::select(DB::raw
                  ("select * from proposal where jenis_proposal='delegasi' and status = 0 "));

    	$jumlah = count($t);

    	return $jumlah;
    }

    //jumlah proposal penyelenggara
    public static function penyelenggara()
    {
    	$t = DB::select(DB::raw
                  ("select * from proposal where jenis_proposal='penyelenggara' and status = 0 "));

    	$jumlah = count($t);

    	return $jumlah;
    }

    //jumlah proposal lainnya
    public static function lainnya()
    {
    	$t = DB::select(DB::raw
                  ("select * from proposal where jenis_proposal='lainnya' and status = 0 "));

    	$jumlah = count($t);

    	return $jumlah;
    }

    //jumlah proposal yang belum disetujui
    public static function all()
    {
    	$t = DB::select(DB::raw
                  ("select * from proposal where status = 0 "));

    	$jumlah = count($t);

    	return $jumlah;
    }

    //jumlah proposal yang ditolak
    public static function TolakFakultas()
    {
        $t = DB::select(DB::raw
                  ("select * from proposal where status = 2 and sumberdana =1"));

        $jumlah = count($t);

        return $jumlah;
    }

    //jumlah proposal fakultas yang belum disetujui
    public static function Fakultas()
    {
        $t = DB::select(DB::raw
                  ("select * from proposal where status = 0 and sumberdana =1"));

        $jumlah = count($t);

        return $jumlah;
    }
    
    //jumlah proposal departemen yang belum disetujui
    public static function Departemen($dept)
    {
        //$departemen = UserHelp::datauser()->id_departemen;
        $t = DB::select(DB::raw("select * from proposal where status = 0 and sumberdana = 2 and departemen ='".$dept."' order by created_at desc"));

        $jumlah = count($t);

        return $jumlah;
    }
    
    //jumlah proposal yang ditolak
    public static function TolakDepartemen($dept)
    {
        //$departemen = UserHelp::datauser()->id_departemen;
        $t = DB::select(DB::raw("select * from proposal where status = 2 and sumberdana = 2 and departemen ='".$dept."' order by created_at desc"));

        $jumlah = count($t);

        return $jumlah;
    }

    //jumlah proposal delegasi tiap mahasiswa
    public static function mahasiswaDel($nim)
    {
        //$departemen = UserHelp::datauser()->id_departemen;
        $t = DB::Select(DB::raw(
            "select a.id,jenis_proposal,nama_kegiatan,jenis_kegiatan,bentuk_kegiatan,
            jenis_rekognisi,tglmulai,tglselesai,url,tingkat,ajuandana,status from proposal a inner join anggota_proposal b on a.id = b.id_proposal
            where b.NIM = '".$nim."' and a.jenis_proposal = 'delegasi' and status != 5"));

        $jumlah = count($t);

        return $jumlah;
    }

    //jumlah proposal penyelenggara tiap mahasiswa
    public static function mahasiswaPen($nim)
    {
        //$departemen = UserHelp::datauser()->id_departemen;
        $t = DB::Select(DB::raw(
            "select a.id,jenis_proposal,nama_kegiatan,jenis_kegiatan,bentuk_kegiatan,
            jenis_rekognisi,tglmulai,tglselesai,url,tingkat,ajuandana,status from proposal a inner join anggota_proposal b on a.id = b.id_proposal
            where b.NIM = '".$nim."' and a.jenis_proposal = 'penyelenggara' and status != 5 "));

        $jumlah = count($t);

        return $jumlah;
    }

    public static function setujuiFak()
    {
        //$departemen = UserHelp::datauser()->id_departemen;
        $t = DB::select(DB::raw("select * from proposal where status = 1 and sumberdana = 1 order by created_at desc"));

        $jumlah = count($t);

        return $jumlah;
    }

    public static function setujuiDept($dept)
    {
        //$departemen = UserHelp::datauser()->id_departemen;
        $t = DB::select(DB::raw("select * from proposal where status = 1 and sumberdana = 2 and departemen ='".$dept."' order by created_at desc"));

        $jumlah = count($t);

        return $jumlah;
    }

    //departemen
    public static function proposaldisetujui($dept) 
    {
        //$departemen = UserHelp::datauser()->id_departemen;
        $t = DB::select(DB::raw("select a.id from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 2 and departemen ='".$dept."' and b.status = 0 order by a.created_at desc"));
        $jumlah = array();

        foreach ($t as $key => $value) {
            
            if(CekLengkap::cek($value->id) == false){
                $jumlah[] = $value->id;
            }
        }
        if(isset($jumlah)){
            return count($jumlah);
        } else{
            $jumlah = 0;
            return $jumlah;
        }
    }

    //fakultas
    public static function proposaldisetujuifk()
    {
        //$departemen = UserHelp::datauser()->id_departemen;
        $t = DB::select(DB::raw("select a.* from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 1 and b.status=0 order by a.created_at desc"));

        foreach ($t as $key => $value) {
            if(CekLengkap::cek($value->id) == false){
                $jumlah[] = $value->id;
            }
        }
        if(isset($jumlah)){
            return count($jumlah);
        } else{
            $jumlah = 0;
            return $jumlah;
        }
    }

    //departemen
    public static function daftarlpj($dept)
    {
        //$departemen = UserHelp::datauser()->id_departemen;
        $t = DB::select(DB::raw("select a.id from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 2 and departemen ='".$dept."' and b.status = 0 order by a.created_at desc"));

        $jumlah = array();
        foreach ($t as $key => $value) {
            if(CekLengkap::cek($value->id) == true){
                $jumlah[] = $value->id;
            }
        }

        if(isset($jumlah)){
            return count($jumlah);
        } else{
            $jumlah = 0;
            return $jumlah;
        }
    }

    //fakultas
    public static function daftarlpjfk()
    {
        //$departemen = UserHelp::datauser()->id_departemen;
        $t = DB::select(DB::raw("select a.* , b.status stat from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 1 and b.status=0 order by a.created_at desc"));
        
        $jumlah = array();
        foreach ($t as $key => $value) {
            if(CekLengkap::cek($value->id) == true){
                $jumlah[] = $value->id;
            }
        }
        if(isset($jumlah)){
            return count($jumlah);
        } else{
            $jumlah = 0;
            return $jumlah;
        }
    }

    public static function lpjcairfk()
    {
        $t = DB::select(DB::raw("select * from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 1 and b.status=1 order by a.created_at desc"));

        $jumlah = count($t);
        return $jumlah;
    }

    public static function lpjcairdept($dept)
    {
        //$departemen = UserHelp::datauser()->id_departemen;
        $t = DB::select(DB::raw("select * from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 2 and departemen ='".$dept."' and b.status=1 order by a.created_at desc"));

        $jumlah = count($t);
        return $jumlah;
    }

    public static function thisyearDelegasiLomba(){
        $tahun = date('Y');
        $t = DB::select(DB::raw
                  ("select * from proposal where nomor_proposal like '%DL%' and status = 1 and created_at like '%".$tahun."%' "));

        $jumlah = count($t);

        return $jumlah;
    }

    public static function thisyearDelegasiNonLomba(){
        $tahun = date('Y');
        $t = DB::select(DB::raw
                  ("select * from proposal where nomor_proposal like '%DN%' and status = 1 and created_at like '%".$tahun."%' "));

        $jumlah = count($t);

        return $jumlah;
    }

    public static function thisyearPenyelenggaraLomba(){
        $tahun = date('Y');
        $t = DB::select(DB::raw
                  ("select * from proposal where nomor_proposal like '%PO%' and status = 1 and created_at like '%".$tahun."%' "));

        $jumlah = count($t);

        return $jumlah;
    }

    public static function thisyearPenyelenggaraPengabdian(){
        $tahun = date('Y');
        $t = DB::select(DB::raw
                  ("select * from proposal where nomor_proposal like '%PU%' and status = 1 and created_at like '%".$tahun."%' "));

        $jumlah = count($t);

        return $jumlah;
    }
    public static function thisyearPenyelenggaraSoftskill(){
        $tahun = date('Y');
        $t = DB::select(DB::raw
                  ("select * from proposal where nomor_proposal like '%PS%' and status = 1 and created_at like '%".$tahun."%' "));

        $jumlah = count($t);

        return $jumlah;
    }
}