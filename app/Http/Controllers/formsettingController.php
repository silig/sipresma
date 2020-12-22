<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\formcetak;

class formsettingController extends Controller
{
    public static function index(){
    	$data = formcetak::all();

    	return view('formsetting.index', compact('data'));
    }

    public function update(Request $request,$id)
    {
    	try {

	    		//select data berdasarkan id
	    		$dept = formcetak::findOrfail($id);
	    		//update data
	    		$dept->update([
	    			'nama' => $request->nama,
	    			'nip' => $request->nip,
	    			'jabatan' => $request->jabatan,
	    			]);

	    		return redirect()->back()->with(['success' => 'berhasil diupdate']);
    		
    	} catch(\Exception $e){
    		//jika gagal, redirect ke form yang sama lalu membuat flash message error
    		return redirect()->back()->with(['error' => $e->getMessage()]);
    	}
    }
}
