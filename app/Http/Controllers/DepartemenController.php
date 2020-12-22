<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use DB;

class DepartemenController extends Controller
{
    public function index()
    {
    	$departemen = Departemen::all();

    	return view('departemen.index', compact('departemen'));
    }

    public function update(Request $request,$id)
    {
    	try {

	    		//select data berdasarkan id
	    		$dept = Departemen::findOrfail($id);
	    		//update data
	    		$dept->update([
	    			'nama_departemen' => ucwords($request->nama),
	    			'kadep' => $request->kadep,
	    			'nip' => $request->nip
	    			]);

	    		return redirect()->back()->with(['success' => 'berhasil diupdate']);
    		
    	} catch(\Exception $e){
    		//jika gagal, redirect ke form yang sama lalu membuat flash message error
    		return redirect()->back()->with(['error' => $e->getMessage()]);
    	}
    }
}
