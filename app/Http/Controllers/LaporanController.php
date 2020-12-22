<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\Dana;
use App\DanaDetail;
use App\Proposal;
use DB;

class LaporanController extends Controller
{
    public static function index(){

    	$departemen = Departemen::all();
    	return view('laporan.index', compact('departemen'));
    }

    public static function hasil(Request $request){

    	//dicek dulu apakah inputn kosong atau tidak
    	if($request->tahun == '' || $request->dept == '' ){
    		return redirect()->back()->with(['error' =>'oke']);
    	} else {
    		//dana milik fakultas
    		if ($request->dept == 99){
    				$dana = Dana::where('tahun', $request->tahun)->where('departemen','like','%fakultas%')->first();
    				//jika dana belum diisi
    				if(is_null($dana)) {
    					$proposal = DB::select(DB::raw("
	    					select a.id, a.nomor_proposal,a.nama_kegiatan,a.tglmulai,a.tglselesai,a.danadisetujui,a.file_proposal,
	    					b.terlaksana,b.capaian,b.file_reportase,b.file_lpj,b.file_dokumentasi,b.file_surat_tugas from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 1 and b.status = 1
	    					
	    					ORDER BY a.created_at ")); 
	    				$data = json_decode (json_encode (
	    						["jumlahdana" => 0,
	    						 "jumlahterpakai" => 0,
	    						 "blmdialokasi" => 0,
	    						 //jumlah masing2 dana
	    						 "danadl" =>  0 ,
	    						 "danadn" =>  0 ,
	    						 "danapo" =>  0 ,
	    						 "danaps" =>  0 ,
	    						 "danapu" =>  0 ,
	    						 //jumlah dana terpakai
	    						 "jumlahdl" => 0,
	    						 "jumlahdn" => 0,
	    						 "jumlahpo" => 0,
	    						 "jumlahps" => 0,
	    						 "jumlahpu" => 0,
	    						 //sisa dana
	    						 "sisa" => 0,
	    						 "sisadl" => 0,
	    						 "sisadn" => 0,
	    						 "sisapo" => 0,
	    						 "sisaps" => 0,
	    						 "sisapu" => 0,
	    						 
	    						 "dana" => 'Fakultas',
	    						 "tahun" => $request->tahun
	    						 ]),false);

	    				
	    				return view('laporan.hasil', compact('data','proposal'));
	    			}
	    			//jika dana sudah terisi
	    			else {

	    				//mengecek dana detail
	    				$danadl = DanaDetail::where('id_dana', $dana->id)->where('jenis', 'DL')->first();
	    				$danadn = DanaDetail::where('id_dana', $dana->id)->where('jenis', 'DN')->first();
	    				$danapo = DanaDetail::where('id_dana', $dana->id)->where('jenis', 'PL')->first();
	    				$danaps = DanaDetail::where('id_dana', $dana->id)->where('jenis', 'PS')->first();
	    				$danapu = DanaDetail::where('id_dana', $dana->id)->where('jenis', 'PU')->first();
	    				
	    				$proposal = DB::select(DB::raw("
	    					select a.id, a.nomor_proposal,a.nama_kegiatan,a.tglmulai,a.tglselesai,a.danadisetujui,a.file_proposal,
	    					b.terlaksana,b.capaian,b.file_reportase,b.file_lpj,b.file_dokumentasi,b.file_surat_tugas from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 1 and b.status = 1
	    					
	    					ORDER BY a.created_at ")); 

	    				//Dana yang terpakai untuk semua proposal di fakultas
	    				$jumlahterpakai = DB::select(DB::raw("
	    					select coalesce(sum(danadisetujui),0) danaterpakai from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 1 and b.status = 1
	    					"));   

	    				//Dana DL yg terpakai di fakultas
	    				$jumlahdl = DB::select(DB::raw("
	    					select coalesce(sum(danadisetujui),0) danaterpakai from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 1 and b.status = 1
	    					and SUBSTRING(nomor_proposal,1,2) = 'DL' "));   

	    				//Dana DN yg terpakai di fakultas
	    				$jumlahdn = DB::select(DB::raw("
	    					select coalesce(sum(danadisetujui),0) danaterpakai from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 1 and b.status = 1
	    					and SUBSTRING(nomor_proposal,1,2) = 'DN' "));

	    				//Dana PO yg terpakai di fakultas
	    				$jumlahpo = DB::select(DB::raw("
	    					select coalesce(sum(danadisetujui),0) danaterpakai from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 1 and b.status = 1
	    					and SUBSTRING(nomor_proposal,1,2) = 'PL' ")); 

	    				//Dana PS yg terpakai di fakultas
	    				$jumlahps = DB::select(DB::raw("
	    					select coalesce(sum(danadisetujui),0) danaterpakai from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 1 and b.status = 1
	    					and SUBSTRING(nomor_proposal,1,2) = 'PS' "));

	    				//Dana PU yg terpakai di fakultas
	    				$jumlahpu = DB::select(DB::raw("
	    					select coalesce(sum(danadisetujui),0) danaterpakai from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 1 and b.status = 1
	    					and SUBSTRING(nomor_proposal,1,2) = 'PU' "));

	    				//dana teralokasikan
	    				$alokasi = DB::select(DB::raw("
	    					select sum(jumlah) jumlah from danadetail where id_dana = ".$dana->id." "));
	    				
	    				//sisa dana dari total dana
	    				$sisa = $dana->jumlah - $jumlahterpakai[0]->danaterpakai;
	    				//DANA BELUM TERALOKASIKAN
	    				$blmdialokasi = $dana->jumlah - $alokasi[0]->jumlah;
	    				//sisa dana DL dari total dana
	    				$sisadl = ($danadl->jumlah ?? 0) - ($jumlahdl[0]->danaterpakai);
	    				$sisadn = ($danadn->jumlah ?? 0) - ($jumlahdn[0]->danaterpakai);
	    				$sisapo = ($danapo->jumlah ?? 0) - ($jumlahpo[0]->danaterpakai);
	    				$sisaps = ($danaps->jumlah ?? 0) - ($jumlahps[0]->danaterpakai);
	    				$sisapu = ($danapu->jumlah ?? 0) - ($jumlahpu[0]->danaterpakai);
	    				

	    				//merubah array menjadi object
	    				$data = json_decode (json_encode (
	    						["jumlahdana" => $dana->jumlah,
	    						 "jumlahterpakai" => $jumlahterpakai[0]->danaterpakai,
	    						 "blmdialokasi" => $blmdialokasi,
	    						 //jumlah masing2 dana
	    						 "danadl" => $danadl->jumlah ?? 0 ,
	    						 "danadn" => $danadn->jumlah ?? 0 ,
	    						 "danapo" => $danapo->jumlah ?? 0 ,
	    						 "danaps" => $danaps->jumlah ?? 0 ,
	    						 "danapu" => $danapu->jumlah ?? 0 ,
	    						 //jumlah dana terpakai
	    						 "jumlahdl" => $jumlahdl[0]->danaterpakai,
	    						 "jumlahdn" => $jumlahdn[0]->danaterpakai,
	    						 "jumlahpo" => $jumlahpo[0]->danaterpakai,
	    						 "jumlahps" => $jumlahps[0]->danaterpakai,
	    						 "jumlahpu" => $jumlahpu[0]->danaterpakai,
	    						 //sisa dana
	    						 "sisa" => $sisa,
	    						 "sisadl" => $sisadl,
	    						 "sisadn" => $sisadn,
	    						 "sisapo" => $sisapo,
	    						 "sisaps" => $sisaps,
	    						 "sisapu" => $sisapu,

	    						 "dana" => 'Fakultas',
	    						 "tahun" => $request->tahun
	    						 ]),false);

	    				
	    				return view('laporan.hasil', compact('data','proposal'));
	    				// return view('laporan.hasil', compact('dana','danadelegasi','danapenyelenggara','proposal','jumlahterpakai','sisa'));
	    			} 

    			
    		} 
    		//Jika memilih Departemen
    		else{
    				
    				$dept = Departemen::where('id', $request->dept)->first();
    				$dana = Dana::where('tahun', $request->tahun)->where('departemen', 'like', '%'.$dept->nama_departemen.'%')->first();
    				//Jika dana kosong atau belum diinput
    				if(is_null($dana)) {
	    				
	    				$proposal = DB::select(DB::raw("
	    					select a.id, a.nomor_proposal,a.nama_kegiatan,a.tglmulai,a.tglselesai,a.danadisetujui,a.file_proposal,
	    					b.terlaksana,b.capaian,b.file_reportase,b.file_lpj,b.file_dokumentasi,b.file_surat_tugas from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 2 and b.status = 1 and departemen = ".$request->dept."
	    					
	    					ORDER BY a.created_at "));  
	    				
	    				$data = json_decode (json_encode (
	    						["jumlahdana" => 0,
	    						 "jumlahterpakai" => 0,
	    						 "blmdialokasi" => 0,
	    						 //jumlah masing2 dana
	    						 "danadl" =>  0 ,
	    						 "danadn" =>  0 ,
	    						 "danapo" =>  0 ,
	    						 "danaps" =>  0 ,
	    						 "danapu" =>  0 ,
	    						 //jumlah dana terpakai
	    						 "jumlahdl" => 0,
	    						 "jumlahdn" => 0,
	    						 "jumlahpo" => 0,
	    						 "jumlahps" => 0,
	    						 "jumlahpu" => 0,
	    						 //sisa dana
	    						 "sisa" => 0,
	    						 "sisadl" => 0,
	    						 "sisadn" => 0,
	    						 "sisapo" => 0,
	    						 "sisaps" => 0,
	    						 "sisapu" => 0,
	    						 
	    						 "dana" => 'Fakultas',
	    						 "tahun" => $request->tahun
	    						 ]),false);

	    				
	    				return view('laporan.hasil', compact('data','proposal'));
	    			}else {
    					
	    				//mengecek dana detail
	    				$danadl = DanaDetail::where('id_dana', $dana->id)->where('jenis', 'DL')->first();
	    				$danadn = DanaDetail::where('id_dana', $dana->id)->where('jenis', 'DN')->first();
	    				$danapo = DanaDetail::where('id_dana', $dana->id)->where('jenis', 'PL')->first();
	    				$danaps = DanaDetail::where('id_dana', $dana->id)->where('jenis', 'PS')->first();
	    				$danapu = DanaDetail::where('id_dana', $dana->id)->where('jenis', 'PU')->first();
	    				
	    				$proposal = DB::select(DB::raw("
	    					select a.id, a.nomor_proposal,a.nama_kegiatan,a.tglmulai,a.tglselesai,a.danadisetujui,a.file_proposal,
	    					b.terlaksana,b.capaian,b.file_reportase,b.file_lpj,b.file_dokumentasi,b.file_surat_tugas from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 2 and b.status = 1 and departemen = ".$request->dept."
	    					ORDER BY a.created_at "));  

	    				//Dana yang terpakai untuk semua proposal di departemen
	    				$jumlahterpakai = DB::select(DB::raw("
	    					select coalesce(sum(danadisetujui),0) danaterpakai from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 2 and b.status = 1 and departemen = ".$request->dept."
	    					"));   
	    				
	    				//Dana DL yg terpakai di departemen
	    				$jumlahdl = DB::select(DB::raw("
	    					select coalesce(sum(danadisetujui),0) danaterpakai from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 2 and b.status = 1 and departemen = ".$request->dept."
	    					and SUBSTRING(nomor_proposal,1,2) = 'DL' "));   

	    				//Dana DN yg terpakai di departemen
	    				$jumlahdn = DB::select(DB::raw("
	    					select coalesce(sum(danadisetujui),0) danaterpakai from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 2 and b.status = 1 and departemen = ".$request->dept."
	    					and SUBSTRING(nomor_proposal,1,2) = 'DN' "));

	    				//Dana PO yg terpakai di departemen
	    				$jumlahpo = DB::select(DB::raw("
	    					select coalesce(sum(danadisetujui),0) danaterpakai from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 2 and b.status = 1 and departemen = ".$request->dept."
	    					and SUBSTRING(nomor_proposal,1,2) = 'PL' ")); 

	    				//Dana PS yg terpakai di departemen
	    				$jumlahps = DB::select(DB::raw("
	    					select coalesce(sum(danadisetujui),0) danaterpakai from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 2 and b.status = 1 and departemen = ".$request->dept."
	    					and SUBSTRING(nomor_proposal,1,2) = 'PS' "));

	    				//Dana PU yg terpakai di departemen
	    				$jumlahpu = DB::select(DB::raw("
	    					select coalesce(sum(danadisetujui),0) danaterpakai from proposal a 
	    					join lpj b on a.id = b.id_proposal
	    					where a.status = 1 and a.created_at like '%".$request->tahun."%' and a.sumberdana = 2 and b.status = 1 and departemen = ".$request->dept."
	    					and SUBSTRING(nomor_proposal,1,2) = 'PU' "));

	    				//dana teralokasikan
	    				$alokasi = DB::select(DB::raw("
	    					select sum(jumlah) jumlah from danadetail where id_dana = ".$dana->id." "));
	    				//DANA BELUM TERALOKASIKAN
	    				$blmdialokasi = $dana->jumlah - $alokasi[0]->jumlah;

	    				//sisa dana dari total dana
	    				$sisa = $dana->jumlah - $jumlahterpakai[0]->danaterpakai;
	    				//sisa dana DL dari total dana
	    				$sisadl = ($danadl->jumlah ?? 0) - ($jumlahdl[0]->danaterpakai);
	    				$sisadn = ($danadn->jumlah ?? 0) - ($jumlahdn[0]->danaterpakai);
	    				$sisapo = ($danapo->jumlah ?? 0) - ($jumlahpo[0]->danaterpakai);
	    				$sisaps = ($danaps->jumlah ?? 0) - ($jumlahps[0]->danaterpakai);
	    				$sisapu = ($danapu->jumlah ?? 0) - ($jumlahpu[0]->danaterpakai);
	    				

	    				//merubah array menjadi object
	    				$data = json_decode (json_encode (
	    						["jumlahdana" => $dana->jumlah,
	    						 "jumlahterpakai" => $jumlahterpakai[0]->danaterpakai,
	    						 "blmdialokasi" => $blmdialokasi,
	    						 //jumlah masing2 dana
	    						 "danadl" => $danadl->jumlah ?? 0 ,
	    						 "danadn" => $danadn->jumlah ?? 0 ,
	    						 "danapo" => $danapo->jumlah ?? 0 ,
	    						 "danaps" => $danaps->jumlah ?? 0 ,
	    						 "danapu" => $danapu->jumlah ?? 0 ,
	    						 //jumlah dana terpakai
	    						 "jumlahdl" => $jumlahdl[0]->danaterpakai,
	    						 "jumlahdn" => $jumlahdn[0]->danaterpakai,
	    						 "jumlahpo" => $jumlahpo[0]->danaterpakai,
	    						 "jumlahps" => $jumlahps[0]->danaterpakai,
	    						 "jumlahpu" => $jumlahpu[0]->danaterpakai,
	    						 //sisa dana
	    						 "sisa" => $sisa,
	    						 "sisadl" => $sisadl,
	    						 "sisadn" => $sisadn,
	    						 "sisapo" => $sisapo,
	    						 "sisaps" => $sisaps,
	    						 "sisapu" => $sisapu,

	    						 "dana" => $request->nama_departemen,
	    						 "tahun" => $request->tahun
	    						 ]),false);

	    				
	    				return view('laporan.hasil', compact('data','proposal'));
	    				// return view('laporan.hasil', compact('dana','danadelegasi','danapenyelenggara','proposal','jumlahterpakai','sisa'));
	    			} 
    			
    		}
    	}
    }
}
