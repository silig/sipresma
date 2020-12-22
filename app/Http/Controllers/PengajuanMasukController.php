<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use UserHelp;
use DanaSisa;
use App\Proposal;
use App\Dana;
use App\Departemen;
use App\LPJ;

class PengajuanMasukController extends Controller
{
//menu untuk fakultas
    public function fakultas(){
        // dd(DanaSisa::sisa('delegasi',99,2019));
    	$proposal = DB::select(DB::raw("select * from proposal where status = 0 and sumberdana = 1 order by created_at desc"));
    	return view('pengajuanmasuk.index', compact('proposal'));
    }

    public function proposaldisetujuifakultas(){
        //$departemen = UserHelp::datauser()->id_departemen;
        $lpj = DB::select(DB::raw("select a.* from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 1 and departemen = 99 and b.status= 0 order by created_at desc"));
        

        return view('pengajuanmasuk.proposaldisetujui', compact('lpj'));
    }

    public function proposalditolakfakultas(){
        //$departemen = UserHelp::datauser()->id_departemen;
        $lpj = DB::select(DB::raw("select a.* from proposal a  where a.status = 2 and a.sumberdana = 1 and a.departemen = 99  order by created_at desc"));
        

        return view('pengajuanmasuk.proposalditolak', compact('lpj'));
    }

    public function lpjmasukfakultas(){
        //$departemen = UserHelp::datauser()->id_departemen;
        $lpj = DB::select(DB::raw("select a.* from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 1 and departemen = 99 and b.status= 0 order by created_at desc"));
        

        return view('pengajuanmasuk.lpjmasuk', compact('lpj'));
    }

    public function danafakultas(){

        $dana = Dana::where('departemen', 'Fakultas')->orderBy('created_at', 'DESC')->paginate(10);
        return view('dana.fakultas.index', compact('dana'));
    }
    
    public function lpjdisetujuifakultas(){
        //$departemen = UserHelp::datauser()->id_departemen;
        $lpj = DB::select(DB::raw("select a.* from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 1 and departemen = 99 and b.status= 1 order by created_at desc"));
        

        return view('pengajuanmasuk.lpjdisetujui', compact('lpj'));
    }

    public function lpjditolakfakultas(){
        //$departemen = UserHelp::datauser()->id_departemen;
        $lpj = DB::select(DB::raw("select a.* from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 1 and departemen = 99 and b.status= 2 order by created_at desc"));
        

        return view('pengajuanmasuk.lpjditolak', compact('lpj'));
    }

//menu untuk departemen
    public function departemen(){
        //dd(UserHelp::datauser()->id_departemen);
        $departemen = UserHelp::datauser()->id_departemen;
        $proposal = DB::select(DB::raw("select * from proposal where status = 0 and sumberdana = 2 and departemen ='".$departemen."' order by created_at desc"));

        return view('pengajuanmasuk.index', compact('proposal'));
    }

    public function proposaldisetujuidepartemen(){
        $departemen = UserHelp::datauser()->id_departemen;
        $lpj = DB::select(DB::raw("select a.* from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 2 and departemen ='".$departemen."' and b.status= 0 order by created_at desc"));
        

        return view('pengajuanmasuk.proposaldisetujui', compact('lpj'));
    }

    public function proposalditolakdepartemen(){
        $departemen = UserHelp::datauser()->id_departemen;
        $lpj = DB::select(DB::raw("select * from proposal where status = 2 and sumberdana = 2 and departemen ='".$departemen."' order by created_at desc"));

        return view('pengajuanmasuk.proposalditolak', compact('lpj'));
    }

    public function lpjmasukdepartemen(){
        $departemen = UserHelp::datauser()->id_departemen;
        $lpj = DB::select(DB::raw("select a.* from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 2 and departemen ='".$departemen."' and b.status= 0 order by created_at desc"));
        

        return view('pengajuanmasuk.lpjmasuk', compact('lpj'));
    }

    public function danadepartemen(){

        $departemen = Departemen::where('id',UserHelp::datauser()->id_departemen)->get();
        $dana = Dana::where('departemen', $departemen[0]->nama_departemen)->orderBy('created_at', 'DESC')->paginate(10);
        //dd($dana);
        return view('dana.departemen.index', compact('dana','departemen'));
    }

    public function lpjdisetujuidepartemen(){
        $departemen = UserHelp::datauser()->id_departemen;
        $lpj = DB::select(DB::raw("select a.* from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 2 and departemen ='".$departemen."' and b.status= 1 order by created_at desc"));
        

        return view('pengajuanmasuk.lpjdisetujui', compact('lpj'));
    }

    public function lpjditolakdepartemen(){
        $departemen = UserHelp::datauser()->id_departemen;
        $lpj = DB::select(DB::raw("select a.* from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 2 and departemen ='".$departemen."' and b.status= 2 order by created_at desc"));
        

        return view('pengajuanmasuk.lpjditolak', compact('lpj'));
    }




//Umum
    public function tambahdana(Request $request)
    {
        $departemen = Departemen::where('id',UserHelp::datauser()->id_departemen)->get();
        $dana = Dana::orderBy('id', 'ASC')->get();

        //dd(empty($departemen));
        //cek tahun dan departemen
        foreach ($dana as $coy) {
            if(isset($departemen[0]->nama_departemen)){
                if ($coy->tahun == $request->tahun && $coy->departemen == $departemen[0]->nama_departemen){
                    return redirect()->back()->with(['error' => 'dana sudahada']);
                }
            } else {
                if ($coy->tahun == $request->tahun && $coy->departemen == 'Fakultas'){
                    return redirect()->back()->with(['error' => 'dana sudah ada']);
                }
            }        
        }

        try {

            if(isset($departemen[0]->nama_departemen)){
            $dana =Dana::firstOrCreate([
                'tahun' => $request->tahun,
                'departemen' => $departemen[0]->nama_departemen,
                'jumlah' => $request->jumlah]);
            } else {
               $dana =Dana::firstOrCreate([
                'tahun' => $request->tahun,
                'departemen' => 'Fakultas',
                'jumlah' => $request->jumlah]); 
            }



            return redirect()->back()->with(['success' => 'Dana tahun '.$dana->tahun.' ditambahkan sejumlah Rp. '.$dana->jumlah]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
 
    public function approve(Request $request, $id){

        $di = decrypt($id);
        
        $cekdana = DanaSisa::dana($request->jenis,$request->dept,$request->tahun);
        
        if(isset($cekdana)){
            $proposal = Proposal::findOrFail($di);
            $proposal->update([
                    'status' => 1,
                    'menyetujui' => UserHelp::datauser()->username,
                    'danadisetujui' =>$request->danadisetujui
                    ]);
            $ceklpj = LPJ::where('id_proposal', $di)->first();
            
            if(!isset($ceklpj)){
                $lpj = LPJ::create([
                        'nomorproposal' => $proposal->nomor_proposal,
                        'id_proposal' => $proposal->id,
                        'status' => 0,
                    ]);
            }
            return redirect()->back()->with(['success' => 'Proposal dengan nomor '.$proposal->nomor_proposal.' berhasil disetujui']);
        }
        if (!isset($cekdana)) {
            return redirect()->back()->with(['error' => 'Dana anggaran tahun ini belum diatur,silahkan atur dulu']);
        }
    }

    //ubah proposal tolak menjadi approve
    public function proposalbisalanjut(Request $request,$id){
        $proposal = Proposal::findOrFail($di);
            $proposal->update([
                    'status' => 1,
                    'menyetujui' => UserHelp::datauser()->username,
                    'danadisetujui' =>$request->danadisetujui
                    ]);
        return redirect()->back()->with(['success' => 'Proposal dengan nomor '.$proposal->nomor_proposal.' berhasil disetujui']);
    }

    //proposal yang ditolak
    public function tolak(Request $request, $id){
        $di = decrypt($id);
        // $lpj = LPJ::where('id_proposal', $di)->first();
        // if($lpj){
        //     $lpj->update([
        //         'status' => 2,
                
        //         ]);
        // }

        $proposal = Proposal::findOrFail($di);
        $proposal->update([
                'status' => 2,
                'keterangan' =>$request->alasan,
                ]);


        return redirect()->back()->with(['success' => 'Proposal dengan nomor '.$proposal->nomor_proposal.' berhasil ditolak']);
    }
    
    public function approvelpj(Request $request, $id){
        $di = decrypt($id);

        $lpj = LPJ::where('id_proposal', $di)->first();
       
        
        try{
            if(substr($lpj->nomorproposal,0,2) == 'DL' || substr($lpj->nomorproposal,0,2) == 'DN')
            {
                
                if(!isset($lpj->nomorproposal) || !isset($lpj->terlaksana) || !isset($lpj->capaian) || !isset($lpj->file_dokumentasi) || !isset($lpj->file_surat_tugas) || !isset($lpj->file_sertifikat) || !isset($lpj->file_reportase) || !isset($lpj->file_lpj)) 
                {
                    
                    return redirect()->back()->with(['error' => 'LPJ dengan nomor proposal '.$lpj->nomorproposal.' belum dilengkapi']);
                }
                if(isset($lpj->nomorproposal) && isset($lpj->terlaksana) && isset($lpj->capaian) && isset($lpj->file_dokumentasi) && isset($lpj->file_surat_tugas) && isset($lpj->file_sertifikat) && isset($lpj->file_reportase) && isset($lpj->file_lpj)) 
                {
                    
                    $lpj->update([
                    'status' => 1,
                    ]);

                    return redirect()->back()->with(['success' => 'Berhasil menyetujui LPJ dengan nomor '.$lpj->nomorproposal ]);
                }
            }
            if(substr($lpj->nomorproposal,0,2) == 'PU' || substr($lpj->nomorproposal,0,2) == 'PS')
            {
                
                if(isset($lpj->nomorproposal) && isset($lpj->terlaksana) && isset($lpj->jumlahpeserta_kegiatan) && isset($lpj->file_dokumentasi) && isset($lpj->file_reportase) && isset($lpj->file_lpj))
                {
                    ;
                    $lpj->update([
                    'status' => 1,
                    ]);

                    return redirect()->back()->with(['success' => 'Berhasil menyetujui LPJ dengan nomor '.$lpj->nomorproposal]);
                }
                if(!isset($lpj->nomorproposal) || !isset($lpj->terlaksana) || !isset($lpj->jumlahpeserta_kegiatan) || !isset($lpj->file_dokumentasi) || !isset($lpj->file_reportase) || !isset($lpj->file_lpj))
                {
                    
                   return redirect()->back()->with(['error' => 'LPJ dengan nomor proposal '.$lpj->nomorproposal.' belum dilengkapi']);
                }
            }
            if(substr($lpj->nomorproposal,0,2) == 'PL')
            {
                
                if(isset($lpj->nomorproposal) && isset($lpj->terlaksana) && isset($lpj->jmlnegara_peserta_lomba) && isset($lpj->jmluniv_peserta_lomba) && isset($lpj->jmlmahasiswa_peserta_lomba) && isset($lpj->file_dokumentasi) && isset($lpj->file_daftar_pemenang) && isset($lpj->file_reportase) && isset($lpj->file_lpj))
                {
                    $lpj->update([
                    'status' => 1,
                    ]);

                    return redirect()->back()->with(['success' => 'Berhasil menyetujui LPJ dengan nomor '.$lpj->nomorproposal]);
                }
                if(!isset($lpj->nomorproposal) || !isset($lpj->terlaksana) || !isset($lpj->jmlnegara_peserta_lomba) || !isset($lpj->jmluniv_peserta_lomba) || !isset($lpj->jmlmahasiswa_peserta_lomba) || !isset($lpj->file_dokumentasi) || !isset($lpj->file_daftar_pemenang) || !isset($lpj->file_reportase) || !isset($lpj->file_lpj))
                {
                    return redirect()->back()->with(['error' => 'LPJ dengan nomor proposal '.$lpj->nomorproposal.' belum dilengkapi']);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    //lpj ditolak
    public function tolaklpj(Request $request, $id){
        $di = decrypt($id);
        $lpj = LPJ::where('id_proposal', $di)->first();
        if($lpj){
            $lpj->update([
                'status' => 2,
                
                ]);
        }

        return redirect()->back()->with(['success' => 'Proposal dengan nomor '.$proposal->nomor_proposal.' berhasil ditolak']);
    }
}
