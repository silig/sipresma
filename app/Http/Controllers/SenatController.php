<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Departemen;

class SenatController extends Controller
{
    public function proposalbaru(){
    	$proposal = DB::select(DB::raw("select * from proposal where status = 0 order by created_at desc"));
    	$departemen = Departemen::orderBy('id', 'ASC')->get();
    	return view('senat.proposalmasuk', compact('proposal','departemen'));
    }

    public function proposaldisetujui(){
    	$lpj = DB::select(DB::raw("select a.* from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 1 and departemen = 99 and b.status= 0 order by created_at desc"));
    	$departemen = Departemen::orderBy('id', 'ASC')->get();
    	return view('senat.proposaldisetujui', compact('lpj','departemen'));
    }

    public function proposalditolak(){
    	$lpj = DB::select(DB::raw("select * from proposal where status = 2 order by created_at desc"));
    	$departemen = Departemen::orderBy('id', 'ASC')->get();
    	return view('senat.proposalditolak', compact('lpj','departemen'));
    }

    public function lpjmasuk(){

        $lpj = DB::select(DB::raw("select a.* from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 1 and b.status= 0 order by created_at desc"));
        
        $departemen = Departemen::orderBy('id', 'ASC')->get();
        return view('senat.lpjmasuk', compact('lpj','departemen'));
    }

    public function lpjdisetujui(){

        $lpj = DB::select(DB::raw("select a.* from proposal a join lpj b on a.id = b.id_proposal where a.status = 1 and sumberdana = 1 and b.status= 1 order by created_at desc"));
        
        $departemen = Departemen::orderBy('id', 'ASC')->get();
        return view('senat.lpjdisetujui', compact('lpj','departemen'));
    }
}
