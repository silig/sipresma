<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dana;
use App\Departemen;
use App\DanaDetail;
use DB;
use Validator;

class DanaController extends Controller
{
    public function index(){
        $departemen = Departemen::orderBy('id', 'ASC')->get();
	    $dana = Dana::orderBy('tahun', 'asc')->get();
        // $dana = DB::table('dana')
        //     ->join('departemen', 'dana.departemen', '=', 'departemen.nama_departemen')
        //     ->select('dana.*')
        //     ->get();
	    return view('dana.index', compact('dana','departemen'));
	}

	public function store(Request $request)
	{
        // $this->validate($request, [
        //     'tahun' => 'required',
        //     'jumlah' => 'required',
        // ]);

        $dana = Dana::orderBy('id', 'ASC')->get();


        //cek tahun dan departemen
        foreach ($dana as $coy) {
            if ($coy->departemen == $request->departemen && $coy->tahun == $request->tahun  ){
                return redirect()->back()->with(['error' => 'wes enek bro']);
            }
             
        }

		try {
    		$dana =Dana::Create([
    			'tahun' => $request->tahun,
                'departemen' => $request->departemen,
    			'jumlah' => $request->dana]);

    		return redirect()->back()->with(['success' => 'Dana tahun '.$dana->tahun.' ditambahkan sejumlah Rp. '.$dana->jumlah]);
    	} catch (\Exception $e) {
    		return redirect()->back()->with(['error' => $e->getMessage()]);
    	}
	}


	public function update(Request $request, $id){
		$detail = DanaDetail::where('id_dana', $id)->get();
        if (count($detail) > 0) {
            return redirect()->back()->with(['errur' => 'Dana detail masih ada, harap hapus dulu dana detail']);
        } else {

        	try {
        		//select data berdasarkan id
        		$dana = Dana::findOrfail($id);
        		
        		//update data
        		$dana->update([
        			'tahun' => $request->tahun,
        			'jumlah' => $request->dana]);

        		return redirect()->back()->with(['success' => 'berhasil diupdate']);
        	} catch(\Exception $e){
        		//jika gagal, redirect ke form yang sama lalu membuat flash message error
        		return redirect()->back()->with(['error' => $e->getMessage()]);
        	}
        }
	}

	public function detail($id)
	{
		$dana = Dana::find($id);
		$danadetail = DB::Select(DB::raw("select * from danadetail where id_dana = ".$id." "));
		$departemen = Departemen::orderBy('id', 'ASC')->get();
        
		return view('dana.detail', compact('dana', 'danadetail', 'departemen'));
	}

	public function AddDetail(Request $request, $id)
	{


        $this->validate($request, [
            'jenis' => 'required',
            
        ], [
            'jenis.required' => 'Jenis Kegiatan tidak boleh kosong',
        ]);

        $di = decrypt($id);
        $jumlahdana = DB::Select(DB::raw("select jumlah afu from dana where id = ".$di." "));
        
        $sumi = DB::Select(DB::raw("select sum(jumlah) as total from danadetail where id_dana = ".$di." "));
        if(empty($sumi[0]->total)){
            $total = 0;
        }
        if(!empty($sumi[0]->total)){
            $total = $sumi[0]->total;
        }
        
        $jmlhdetail = $total + $request->jumlah;

        $danadetail =DB::table('danadetail')
                ->where('id_dana', $di)
                ->get();
        foreach ($danadetail as $key => $value) {
            if ($value->jenis == $request->jenis){
                 return redirect()->back()->with(['error' => 'dana tersebut sudah ada']);
            }
        }
       
        //jika sudah ada 2 detail maka gak iso nambah
        if(count($danadetail) >= 5){
             return redirect()->back()->with(['error' => 'wes kakehan lek mu nglebokne ']);
        }
        //mengecek apakah sudah ada jenis tersebut
        // if(isset($danadetail->jenis)){
        //      return redirect()->back()->with(['error' => 'dana '.$request->jenis.' sudah ada']);
        // }   
        foreach ($danadetail as $key => $value) {
            if ($value->jenis == $request->jenis){
                 return redirect()->back()->with(['error' => 'dana '.$request->jenis.' sudah ada']);
            }
        }
        //cegatan untuk kelebihan dana
        $susuk = $jmlhdetail - $jumlahdana[0]->afu;
        if($jmlhdetail > $jumlahdana[0]->afu){
            return redirect()->back()->with(['error' => 'Dana yang anda masukkan lebih '.number_format($susuk,0,",",".").' dari total dana']);
        }    
        if(count($danadetail) < 5){

        		try{
        				
        				$danadetail = DanaDetail::Create([
            			'jenis' => $request->jenis,
            			'jumlah' => $request->jumlah,
                        'id_dana' => $di
                        ]);

                        return redirect()->back()->with(['success' => 'berhasil diupdate']);
            		}
            	catch(\Exception $e){
            		return redirect()->back()->with(['error' => $e->getMessage()]);
            	}
        }
	}

    public function hapus($id){
        $dana = Dana::findorfail($id);
        $dana->delete();
        $danadetail = DanaDetail::where('id_dana', $id)->delete();
        return redirect()->back()->with(['success' => 'dana: '.$dana->tahun.' '.$dana->departemen.' dihapus']);
    }

    public function hapusDetail($id){
        $dana = DanaDetail::findorfail($id);
        $dana->delete();
        return redirect()->back()->with(['success' => 'dana dihapus']);
    }
}
