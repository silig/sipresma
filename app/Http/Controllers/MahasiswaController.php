<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mahasiswa;
use App\Departemen;
use DB;
use App\Jurusan;
use App\User;
use App\Imports\mahasiswaimport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Session;

class MahasiswaController extends Controller
{
    public static function index(){

        $angkatan = DB::table('mahasiswa')->max('angkatan');
        // dd($tahun);
        // $angkatan = '2019';
        $jurs = '1';
    	$jurusan = Jurusan::orderBy('program', 'ASC')->get();
        $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user','=', 'users.id')
                     ->where('angkatan',  $angkatan)
                     ->where('id_jurusan', $jurs)
                     ->get(); 
    	return view('mahasiswa.index', compact('mahasiswa','jurusan','angkatan','jurs'));
    }

    public static function cari(Request $request){
        $angkatan = $request->tahun;
        $jurs = $request->jurusan;
        $jurusan = Jurusan::orderBy('program', 'ASC')->get();
        $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user','=', 'users.id')
                     ->where('angkatan',  $angkatan)
                     ->where('id_jurusan', $jurs)
                     ->get();    
        
        return view('mahasiswa.index', compact('mahasiswa','jurusan','angkatan','jurs'));
    }

    public static function update(Request $request, $nim){
        $mahasiswa = Mahasiswa::where('NIM', $nim)->first();
        
        try{

            $jur = Jurusan::findorfail($request->jurusan);
            $id_dept = $jur->id_departemen;
            $user = User::findOrFail($mahasiswa->id_user);
            $password = !empty($request->password) ? bcrypt($request->password):$user->password;
            $user->update([
                'username' => $request->username,
                'password' => $password
            ]);

           Mahasiswa::where('NIM', $nim)->update([
                'nama_mhs' => $request->nama,
                'angkatan' => $request->angkatan,
                'id_jurusan' => $request->jurusan,
                'id_departemen' => $id_dept 
            ]);

            return redirect()->back()
                ->with(['success' => 'berhasil diubah']);
        } catch(\Exception $e){
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    public function add(Request $request){
        try{
            $jur = Jurusan::findorfail($request->jurusan);
            $id_dept = $jur->id_departemen;
            
            $user = User::create([
                    'NIM' => $request->nim,
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'status' => 1,
                    ]);
                $user->find($user->id)->syncRoles('mahasiswa');

                Mahasiswa::create([
                    'NIM' => $request->nim,
                    'nama_mhs' => $request->nama,
                    'id_departemen' => $id_dept,
                    'id_user' => $user->id,
                    'id_jurusan' => $request->jurusan,
                    'angkatan' => $request->angkatan
                    ]);

            return redirect()->back()
                ->with(['success' => 'berhasil ditambahkan']);
        }catch(\Exception $e){
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
    

    public static function getjurusan(Request $req){
	    $id = $req->input('id');
	   	
	    $jur = Jurusan::where('id_departemen', $id)->get();
	    
	    // Buat variabel untuk menampung tag-tag option nya
	    // Set defaultnya dengan tag option Pilih
	    $lists = "<option value=''>Pilih</option>";
	    
	    foreach($jur as $data){
	      $lists .= "<option value='".$data->id."'>".$data->program." ".$data->jurusan."</option>"; // Tambahkan tag option ke variabel $lists
	    }
	    
	    $callback = array('list_kota'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : 
	    echo json_encode($callback); // konversi varibael $callback menjadi JSON
	  }

    public static function getData(){

    	//$data = DB::table('mahasiswa')->where('angkatan', $req->tahun)
    	//							  ->where('id_jurusan', $req->id_jur)
    	//							  ->get();
    	$data = Mahasiswa::join('jurusan', 'id_jurusan', '=', 'id')->get();
        return response()->json($data);
    }

    public function lookup(Request $req){

    	//dd($req->all());
    	$input = $req->input ? $req->input : '';
    	//$mhs = Mahasiswa::where('NIM', 'like', '%'.$input.'%')
    	//				 ->where('nama_mhs', 'like', '%'.$input.'%')->get();
    	$mhs = DB::select(DB::raw("select NIM, nama_mhs, b.program, b.jurusan from mahasiswa a 
        join jurusan b on a.id_jurusan = b.id where NIM like '%".$input."%' or nama_mhs like '%".$input."%' "));
    	
    	return response()->json($mhs);
    }



    public function import(Request $request) 
    {
        ini_set("max_execution_time", (60 *60 *3)); // 3 hours
        ini_set("memory_limit", "40M");
        try{
        $start = microtime(TRUE);
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
 
        // menangkap file excel
        $file = $request->file('file');
 
        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();
 
        // upload ke folder file_siswa di dalam folder public
        $file->move('Import/file_mahasiswa',$nama_file);
 
        // import data
        $impor = new mahasiswaimport;
        Excel::import($impor , public_path('Import/file_mahasiswa/'.$nama_file));
        
        $finish = microtime(TRUE);
        $totaltime = $finish - $start;
        // alihkan halaman kembali
        return redirect()->back()->with(['success' => $impor->getCount().' data berhasil di import dengan waktu '.$totaltime]);;
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

}
