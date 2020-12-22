<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use App\Exports\testing;
use App\Exports\delegasi;
use App\Exports\penyelenggara;

class ReportController extends Controller
{
    public static function delegasi(){

    	return view('report.delegasi');
    }

    //delegasi
    public static function report(Request $request){
    	$request1 = [
    	"tahun" => $request->tahun,
    	"jenis" => $request->jenis,
    	"tingkat" => $request->tingkat
    	];
    	$request = (object) $request1;

    	try{
    		//ketika memilih semua
    		if($request->jenis == 'semua'){
    			if($request->tingkat == 'semua'){
    				//isinya disini
    				$data = DB::select(DB::raw("select a.nomor_proposal, a.id,a.nama_kegiatan,a.tingkat,a.lokasi_kegiatan,a.tglmulai,a.tglselesai,a.url, b.capaian, a.status statuspro, b.status statuslpj from proposal a
    					join lpj b on a.id=b.id_proposal where jenis_proposal = 'delegasi' and a.created_at like '%".$request->tahun."%' and a.status != 5 "));
    				
    				return view('report.hasil1', compact('data','request'));
    			} elseif ($request->tingkat == 'internasional'){
    				//isinya disini
    				$data = DB::select(DB::raw("select a.nomor_proposal, a.id,a.nama_kegiatan,a.tingkat,a.lokasi_kegiatan,a.tglmulai,a.tglselesai,a.url, b.capaian, a.status statuspro, b.status statuslpj from proposal a
    					join lpj b on a.id=b.id_proposal where jenis_proposal = 'delegasi' and   tingkat = 'internasional' and a.created_at like '%".$request->tahun."%' "));

    				return view('report.hasil1', compact('data','request'));
    			} else {
    				$data = DB::select(DB::raw("select a.nomor_proposal, a.id,a.nama_kegiatan,a.tingkat,a.lokasi_kegiatan,a.tglmulai,a.tglselesai,a.url, b.capaian, a.status statuspro, b.status statuslpj from proposal a
    					join lpj b on a.id=b.id_proposal where jenis_proposal = 'delegasi' and  tingkat IN ('nasional','regional') and a.created_at like '%".$request->tahun."%' "));

    				return view('report.hasil1', compact('data','request'));
    			}
    		}
    		//ketika memilih
    		else{
    			if($request->tingkat == 'semua'){
    				//isinya disini
    				$data = DB::select(DB::raw("select a.nomor_proposal, a.id,a.nama_kegiatan,a.tingkat,a.lokasi_kegiatan,a.tglmulai,a.tglselesai,a.url, b.capaian, a.status statuspro, b.status statuslpj from proposal a
    					join lpj b on a.id=b.id_proposal where jenis_proposal = 'delegasi'  and a.created_at like '%".$request->tahun."%' and jenis_kegiatan= '".$request->jenis."' "));
    				return view('report.hasil1', compact('data','request'));

    			} elseif ($request->tingkat == 'internasional'){
    				//isinya disini
    				$data = DB::select(DB::raw("select a.nomor_proposal, a.id,a.nama_kegiatan,a.tingkat,a.lokasi_kegiatan,a.tglmulai,a.tglselesai,a.url, b.capaian, a.status statuspro, b.status statuslpj from proposal a
    					join lpj b on a.id=b.id_proposal where jenis_proposal = 'delegasi' and  tingkat = 'internasional' and a.created_at like '%".$request->tahun."%' and jenis_kegiatan= '".$request->jenis."' "));

    				return view('report.hasi1', compact('data','request'));
    			} else {
    				$data = DB::select(DB::raw("select a.nomor_proposal, a.id,a.nama_kegiatan,a.tingkat,a.lokasi_kegiatan,a.tglmulai,a.tglselesai,a.url, b.capaian, a.status statuspro, b.status statuslpj from proposal a
    					join lpj b on a.id=b.id_proposal where jenis_proposal = 'delegasi' and tingkat IN ('nasional','regional') and a.created_at like '%".$request->tahun."%' and jenis_kegiatan= '".$request->jenis."' "));

    				return view('report.hasil1', compact('data','request'));
    			}
    		}

    	} catch(\Exception $e){
    		return redirect()->back()->with(['error' => $e->getMessage()]);
    	}
    }

    public function export(Request $req){
        //dd($req->all());
        if(isset($req->jenis)){
        	$tahun = $req->tahun;
        	$jenis = $req->jenis;
        	$tingkat = $req->tingkat;
        	return (new delegasi($tahun, $jenis, $tingkat))->download('prestasiku.xlsx');
        }elseif (isset($req->penyelenggara)){
            $tahun = $req->tahun;
            $penyelenggara_kegiatan = $req->penyelenggara;
            $unit = $req->unit;
            return (new penyelenggara($tahun, $penyelenggara_kegiatan, $unit))->download('penyelenggara_'.$penyelenggara_kegiatan.'_'.$tahun.'.xlsx');
        }
    }

    public static function penyelenggara(){

        return view('report.penyelenggara');
    }

    public static function reportpenyelenggara(Request $request){
        //dd($request->all());
        // if($request->penyelenggara_kegiatan == 'UPK'){
        // $unit = $request->unit_kegiatan_upk; 
        // }else if ($request->penyelenggara_kegiatan == 'Himpunan'){
        // $unit = $request->unit_kegiatan_hmj;   
        // } else {
        //     $unit = null;
        // }

        if($request->jenis == 'semua')
            {
                if($request->penyelenggara_kegiatan == 'UPK'){
                        if($request->unit_kegiatan_upk == 'semua'){
                            $req = [
                            'tahun' => $request->tahun,
                            'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                            'unit' => $request->unit_kegiatan_upk
                            ];
                            $req1 = (object) $req;

                            $data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                                join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$request->tahun."%' and penyelenggara_kegiatan = '".$request->penyelenggara_kegiatan."' "));

                            return view('report.hasil2', compact('data','req1'));

                        }else{
                            
                            $req = [
                            'tahun' => $request->tahun,
                            'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                            'unit' => $request->unit_kegiatan_upk
                            ];
                            $req1 = (object) $req;

                            $data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                                join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$request->tahun."%' and penyelenggara_kegiatan = '".$request->penyelenggara_kegiatan."' and unit_kegiatan='".$request->unit_kegiatan_upk."' "));

                            return view('report.hasil2', compact('data','req1'));
                        }            
                }elseif($request->penyelenggara_kegiatan == 'Himpunan'){
                        if($request->unit_kegiatan_hmj == 'semua'){
                            $req = [
                            'tahun' => $request->tahun,
                            'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                            'unit' => 'semua'];
                            $req1 = (object) $req;

                            $data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                                join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$request->tahun."%' and penyelenggara_kegiatan = '".$request->penyelenggara_kegiatan."' "));
                            return view('report.hasil2', compact('data','req1'));
                        }else{
                            $req = [
                            'tahun' => $request->tahun,
                            'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                            'unit' => $request->unit_kegiatan_hmj];
                            $req1 = (object) $req;

                             $data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                                join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$request->tahun."%' and penyelenggara_kegiatan = '".$request->penyelenggara_kegiatan."' and unit_kegiatan='".$request->unit_kegiatan_hmj."' "));

                             return view('report.hasil2', compact('data', 'req1'));
                        }
                }elseif($request->penyelenggara_kegiatan == 'semua'){
                    $req = [
                            'tahun' => $request->tahun,
                            'penyelenggara_kegiatan' => 'semua',
                            'unit' => null ];
                    $req1 = (object) $req;

                    $data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                            join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$request->tahun."%' "));

                    return view('report.hasil2', compact('data','req1'));    
                } else {
                    $req = [
                            'tahun' => $request->tahun,
                            'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                            'unit' => null ];
                    $req1 = (object) $req;

                    $data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                            join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$request->tahun."%' and penyelenggara_kegiatan = '".$request->penyelenggara_kegiatan."' "));

                    return view('report.hasil2', compact('data','req1'));
                }
            } //end memilih jenis semua
            else {
                if($request->penyelenggara_kegiatan == 'UPK'){
                        if($request->unit_kegiatan_upk == 'semua'){
                            
                            $req = [
                            'tahun' => $request->tahun,
                            'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                            'unit' => $request->unit_kegiatan_upk];
                            $req1 = (object) $req;

                            $data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                                join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$request->tahun."%' and penyelenggara_kegiatan = '".$request->penyelenggara_kegiatan."' and jenis_kegiatan= '".$request->jenis."' "));

                            return view('report.hasil2', compact('data','req1'));

                        }else{

                            $req = [
                            'tahun' => $request->tahun,
                            'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                            'unit' => $request->unit_kegiatan_upk];
                            $req1 = (object) $req;

                            $data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                                join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$request->tahun."%' and penyelenggara_kegiatan = '".$request->penyelenggara_kegiatan."' and unit_kegiatan='".$request->unit_kegiatan_upk."' and jenis_kegiatan= '".$request->jenis."' "));

                            return view('report.hasil2', compact('data','req1'));
                        }            
                }elseif($request->penyelenggara_kegiatan == 'Himpunan'){
                        if($request->unit_kegiatan_hmj == 'semua'){
                            $req = [
                            'tahun' => $request->tahun,
                            'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                            'unit' => 'semua'];
                            $req1 = (object) $req;

                            $data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                                join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$request->tahun."%' and penyelenggara_kegiatan = '".$request->penyelenggara_kegiatan."' and jenis_kegiatan= '".$request->jenis."' "));
                            return view('report.hasil2', compact('data','req1'));
                        }else{
                            $req = [
                            'tahun' => $request->tahun,
                            'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                            'unit' => $request->unit_kegiatan_hmj];
                            $req1 = (object) $req;

                             $data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                                join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$request->tahun."%' and penyelenggara_kegiatan = '".$request->penyelenggara_kegiatan."' and unit_kegiatan='".$request->unit_kegiatan_hmj."' and jenis_kegiatan= '".$request->jenis."' "));

                             return view('report.hasil2', compact('data', 'req1'));
                        }
                }elseif($request->penyelenggara_kegiatan == 'semua'){
                    $req = [
                            'tahun' => $request->tahun,
                            'penyelenggara_kegiatan' => 'semua',
                            'unit' => null ];
                    $req1 = (object) $req;

                    $data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                            join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$request->tahun."%' and jenis_kegiatan= '".$request->jenis."' "));

                    return view('report.hasil2', compact('data','req1'));    
                } else {
                    $req = [
                            'tahun' => $request->tahun,
                            'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                            'unit' => null ];
                    $req1 = (object) $req;

                    $data = DB::select(DB::raw("select a.nomor_proposal,a.id,penyelenggara_kegiatan, unit_kegiatan, nama_kegiatan, tglmulai, tglselesai, a.status statuspro, b.status statuslpj from proposal a
                            join lpj b on a.id=b.id_proposal where jenis_proposal = 'penyelenggara' and  a.created_at like '%".$request->tahun."%' and penyelenggara_kegiatan = '".$request->penyelenggara_kegiatan."' and jenis_kegiatan= '".$request->jenis."' "));

                    return view('report.hasil2', compact('data','req1'));
                }
            }
    }
}
