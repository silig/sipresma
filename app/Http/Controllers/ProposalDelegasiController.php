<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use UserHelp;
use App\Proposal;
use App\Anggota_proposal;
use App\Departemen;
use App\LPJ;
use File;
use Storage;
use DB;
use App\Mahasiswa;
use DateTime;
use Carbon\Carbon;
use Response;

class ProposalDelegasiController extends Controller
{
	
	public function datauser(){
		$id = Auth::user()->id; 
		$data = DB::select(DB::raw
                   ("select nama_mhs, NIM, name, email from users a
					 inner join mahasiswa b on a.id = b.id_user
					 where a.id =".$id." "));
		return $data;
	}

    public function index()
    {
        //untuk memfilter 14 hari sebelum today
        // $minim = Carbon::now()->subDays(14)->toDateTimeString();
        // $now = Carbon::now()->toDateTimeString();
        $hari_ini = date("Y-m-d");
        $wingi = date('Y-m-01', strtotime($hari_ini));
        $now = date('Y-m-t', strtotime($hari_ini));
        

        // $proposal = DB::select(DB::raw
        //           ("select * from proposal where jenis_proposal='delegasi' order by id desc"));
        $proposal = DB::select(DB::raw
                  ("select * from proposal where jenis_proposal='delegasi' and created_at BETWEEN '".$wingi."' and '".$now."' and status != 5
                    order by created_at desc"));
        
        $departemen = Departemen::orderBy('id', 'ASC')->get();
        return view('proposal.delegasi.index', compact('proposal','wingi','now','departemen'));
    }

    public function cari(Request $request)
    {

        $wingi = $request->awal;
        $now = $request->akhir;
        
        $proposal = DB::select(DB::raw
                  ("select * from proposal where jenis_proposal='delegasi' and created_at BETWEEN '".$wingi."' and '".$now."' order by created_at "));

        $departemen = Departemen::orderBy('id', 'ASC')->get();
        return view('proposal.delegasi.index', compact('proposal','wingi','now','departemen'));
    }

    public function create()
    {
        $departemen = Departemen::orderBy('id', 'ASC')->get();
        $minim = Carbon::now()->subDays(14)->toDateTimeString();
    	return view('proposal.delegasi.create', compact('departemen', 'minim'));
    }

    public function store(Request $request)
    {
    	ini_set("max_execution_time", (60 *60 *3)); // 3 hours
        ini_set("memory_limit", "40M");
        ini_set("post_max_size","1024M");
        ini_set("upload_max_filesize","15M");
        ini_set('memory_limit','10240M');

        $this->validate($request, [
            'jenis_kegiatan' => 'required|string',
            'nama_kegiatan' => 'required|string|max:100',
            'bentuk_kegiatan' => 'required|string|max:100',
            'tglmulai' => 'required',
            'tglselesai' => 'required',
            'lokasi_kegiatan' => 'required',
            'tingkat' => 'required',
            'nohp' => 'required|numeric',
            'url' => 'required',
            'sumberdana' => 'required',
            'sumberdana1' => 'nullable',
            'jumlah_dana' => 'required',
            'file_surat_undangan' => 'required|mimes:pdf|max:2000',
            'file_proposal' => 'required|mimes:pdf|max:2000',
        ], [
            'jenis_kegiatan.required' => 'Jenis Kegiatan tidak boleh kosong',
            'nama_kegiatan.required' => 'Nama Kegiatan tidak boleh kosong',
            'bentuk_kegiatan.required' => 'Bentuk Kegiatan tidak boleh kosong',
            'tglmulai.required' => 'Tanggal mulai tidak boleh kosong',
            'tglselesai.required' => 'Tanggal selesai tidak boleh kosong',
            'lokasi_kegiatan.required' => 'Lokasi kegiatan tidak boleh kosong',
            'tingkat.required' => 'Tingkat tidak boleh kosong',
            'nohp.required' => 'Tingkat tidak boleh kosong',
            'nohp.numeric' => 'harus angka',
            'url.required' => 'Url tidak boleh kosong',
            'jumlah_dana.required' => 'Jumlah dana tidak boleh kosong',
            'file_surat_undangan.required' => 'File Surat Undangan tidak boleh kosong',
            'file_surat_undangan.mimes' => 'File Surat Undangan Harus berformat .pdf',
            'file_surat_undangan.max' => 'Ukuran File Surat Undangan maksimal 2MB',
            'file_proposal.required' => 'File Proposal tidak boleh kosong',
            'file_proposal.mimes' => 'File Surat Undangan Harus berformat .pdf',
            'file_proposal.max' => 'Ukuran File Proposal maksimal 2MB',
        ]);

        $tahun = date('Y');
    //mencari jumlah lomba untuk menghitung nomor proposal tiap tahun
    $jmlhlomba = DB::Select(DB::raw("select * from proposal where jenis_proposal = 'delegasi' and jenis_kegiatan='lomba' and created_at like '%".$tahun."%' "));
    $jmlhnonlomba = DB::Select(DB::raw("select * from proposal where jenis_proposal = 'delegasi' and jenis_kegiatan='nonlomba' and created_at like '%".$tahun."%' "));
    $numberlomba = str_pad(count($jmlhlomba)+1, 3, '0', STR_PAD_LEFT);
    $numbernonlomba = str_pad(count($jmlhnonlomba)+1, 3, '0', STR_PAD_LEFT);
    
        try {

            $file_surat_undangan = null;
            if ($request->hasFile('file_surat_undangan')) {
                $file_surat_undangan = $this->saveFileSurat($request->nama_kegiatan, $request->file('file_surat_undangan'));
            } 

            $file_proposal = null;
            if ($request->hasFile('file_proposal')) {
                $file_proposal = $this->saveFileProposal($request->nama_kegiatan, $request->file('file_proposal')); 
            } 
            
            if($request->jenis_kegiatan == 'nonlomba'){
                if($request->sumberdana == 2){
                    $proposal = Proposal::create([
                    'jenis_proposal' => 'delegasi',
                    'nomor_proposal' => 'DN'.$numbernonlomba,
                    'jenis_rekognisi' => $request->jenis_rekognisi,
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'jenis_kegiatan' => $request->jenis_kegiatan,
                    'bentuk_kegiatan' => $request->bentuk_kegiatan,
                    'lokasi_kegiatan' => $request->lokasi_kegiatan,
                    'tglmulai' => $request->tglmulai,
                    'tglselesai' => $request->tglselesai,
                    'tingkat' => $request->tingkat,
                    'url' => $request->url,
                    'nohp' => $request->nohp,
                    'sumberdana' => $request->sumberdana,
                    'sumberdana1' => $request->sumberdana1,
                    'danalainnya' => $request->danalain,
                    'departemen' => decrypt($request->departemen),
                    'ajuandana' => $request->jumlah_dana,
                    'file_surat_undangan' => $file_surat_undangan,
                    'file_proposal' => $file_proposal,
                    'status' => 0
                    ]);
                }elseif($request->sumberdana == 1){
                    $proposal = Proposal::create([
                    'jenis_proposal' => 'delegasi',
                    'nomor_proposal' => 'DN'.$numbernonlomba,
                    'jenis_rekognisi' => $request->jenis_rekognisi,
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'jenis_kegiatan' => $request->jenis_kegiatan,
                    'bentuk_kegiatan' => $request->bentuk_kegiatan,
                    'lokasi_kegiatan' => $request->lokasi_kegiatan,
                    'tglmulai' => $request->tglmulai,
                    'tglselesai' => $request->tglselesai,
                    'tingkat' => $request->tingkat,
                    'url' => $request->url,
                    'nohp' => $request->nohp,
                    'sumberdana' => $request->sumberdana,
                    'sumberdana1' => $request->sumberdana1,
                    'danalainnya' => $request->danalain,
                    'departemen' => 99,
                    'ajuandana' => $request->jumlah_dana,
                    'file_surat_undangan' => $file_surat_undangan,
                    'file_proposal' => $file_proposal,
                    'status' => 0
                    ]);
                }
            } else if ($request->jenis_kegiatan=='lomba'){
                 if($request->sumberdana == 2){
                         $proposal = Proposal::create([
                        'jenis_proposal' => 'delegasi',
                        'nomor_proposal' => 'DL'.$numberlomba,
                        'nama_kegiatan' => $request->nama_kegiatan,
                        'jenis_kegiatan' => $request->jenis_kegiatan,
                        'bentuk_kegiatan' => $request->bentuk_kegiatan,
                        'lokasi_kegiatan' => $request->lokasi_kegiatan,
                        'tglmulai' => $request->tglmulai,
                        'tglselesai' => $request->tglselesai,
                        'tingkat' => $request->tingkat,
                        'url' => $request->url,
                        'nohp' => $request->nohp,
                        'sumberdana' => $request->sumberdana,
                        'sumberdana1' => $request->sumberdana1,
                        'danalainnya' => $request->danalain,
                        'departemen' => decrypt($request->departemen),
                        'ajuandana' => $request->jumlah_dana,
                        'file_surat_undangan' => $file_surat_undangan,
                        'file_proposal' => $file_proposal,
                        'status' => 0
                        ]);
                  } else if($request->sumberdana == 1){
                        $proposal = Proposal::create([
                        'jenis_proposal' => 'delegasi',
                        'nomor_proposal' => 'DL'.$numberlomba,
                        'nama_kegiatan' => $request->nama_kegiatan,
                        'jenis_kegiatan' => $request->jenis_kegiatan,
                        'bentuk_kegiatan' => $request->bentuk_kegiatan,
                        'lokasi_kegiatan' => $request->lokasi_kegiatan,
                        'tglmulai' => $request->tglmulai,
                        'tglselesai' => $request->tglselesai,
                        'tingkat' => $request->tingkat,
                        'url' => $request->url,
                        'nohp' => $request->nohp,
                        'sumberdana' => $request->sumberdana,
                        'sumberdana1' => $request->sumberdana1,
                        'danalainnya' => $request->danalain,
                        'departemen' => 99,
                        'ajuandana' => $request->jumlah_dana,
                        'file_surat_undangan' => $file_surat_undangan,
                        'file_proposal' => $file_proposal,
                        'status' => 0
                        ]);
                  }
            }
            // dd($proposal->id);
            
            if (isset(UserHelp::datauser()[0]->NIM)){
            $anggota = Anggota_proposal::create([
                'NIM' => UserHelp::datauser()[0]->NIM,
                'Nama' => UserHelp::datauser()[0]->nama_mhs,
                'jabatan' => 'ketua',
                'id_departemen' => UserHelp::datauser()[0]->id_departemen,
                'id_proposal' => $proposal->id
                ]);
            }

            return redirect(route('delegasi.edit', encrypt($proposal->id)))
                ->with(['success' => 'Proposal <strong>' . $proposal->nama_kegiatan . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFileSurat($name, $surat)
    {
        
        $surat1 = 'surat-'.str_slug($name) . time() . '.' . $surat->getClientOriginalExtension();
        $path = Storage_path('App/public/uploads/SuratUndangan');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        $surat->storeas('public/uploads/SuratUndangan',$surat1);
        //Storage::make($surat)->save($path . '/' . $surat1); 
        //Image::make($photo)->save($path . '/' . $images);
        return $surat1;
    }

    private function saveFileProposal($name, $proposal)
    {
        
        $proposal1 = 'proposal-'.str_slug($name) . time() . '.' . $proposal->getClientOriginalExtension();
        $path = Storage_path('App/public/uploads/Proposal');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 

        $proposal->storeas('public/uploads/Proposal',$proposal1);
        // Storage::make($proposal)->save($path . '/' . $proposal1); 
        return $proposal1;
    }

    public function edit($id)
    {
        $di = decrypt($id);
        $data =  Proposal::find($di);
       // $anggota = Anggota_proposal::where('id_proposal',$id)->orderBy('jabatan', 'desc')->get();
        $anggota= DB::select(DB::raw
                   ("SELECT a.id,NIM, Nama, jabatan, nama_departemen FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal=".$di." " ));
        //dd($anggota);
        $departemen = Departemen::orderBy('id', 'ASC')->get();
        return view ('proposal.delegasi.edit', compact('data','anggota','departemen'));
    }

    public function update(Request $request, $id){
       
        $di = decrypt($id);
        $this->validate($request, [
            'jenis_kegiatan' => 'required|string',
            'nama_kegiatan' => 'required|string|max:100',
            'bentuk_kegiatan' => 'required|string|max:100',
            'tglmulai' => 'required',
            'tglselesai' => 'required',
            'tingkat' => 'required',
            'url' => 'required',
            'sumberdana' => 'nullable',
            'sumberdana1' => 'nullable',
            'jumlah_dana' => 'required',
            'file_surat_undangan' => 'nullable|mimes:pdf',
            'file_proposal' => 'nullable|mimes:pdf',

        ]);

        try {
            $proposal = Proposal::findOrFail($di);
            $file_surat_undangan = $proposal->file_surat_undangan;
            $file_proposal =$proposal->file_proposal;

            if ($request->hasFile('file_surat_undangan')) {
                !empty($file_surat_undangan) ? File::delete(public_path('storage/uploads/SuratUndangan/' . $file_surat_undangan)):null;
                $file_surat_undangan = $this->saveFileSurat($request->nama_kegiatan, $request->file('file_surat_undangan'));
            }

            if ($request->hasFile('file_proposal')) {
                !empty($file_sproposal) ? File::delete(public_path('storage/uploads/Proposal/' . $file_proposal)):null;
                $file_proposal = $this->saveFileProposal($request->nama_kegiatan, $request->file('file_proposal'));
            }

    
            if($request->jenis_kegiatan == 'nonlomba'){
                if ($request->sumberdana ==2 ) {
                $proposal->update([
                'jenis_proposal' => 'delegasi',
                'jenis_rekognisi' => $request->jenis_rekognisi,    //disini yg membedakan nonlomba
                'nama_kegiatan' => $request->nama_kegiatan,
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'bentuk_kegiatan' => $request->bentuk_kegiatan,
                'lokasi_kegiatan' => $request->lokasi_kegiatan,
                'tglmulai' => $request->tglmulai,
                'tglselesai' => $request->tglselesai,
                'tingkat' => $request->tingkat,
                'url' => $request->url,
                'nohp' => $request->nohp,
                'sumberdana' => $request->sumberdana,
                'sumberdana1' => $request->sumberdana1,
                'danalainnya' => $request->danalain,
                'departemen' => decrypt($request->departemen),               //disini yg membedakan jia milih departemen
                'ajuandana' => $request->jumlah_dana,
                'file_surat_undangan' => $file_surat_undangan,
                'file_proposal' => $file_proposal
                ]);
                }else {
                    $proposal->update([
                    'jenis_proposal' => 'delegasi',
                    'jenis_rekognisi' => $request->jenis_rekognisi,    //disini yg membedakan nonlomba
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'jenis_kegiatan' => $request->jenis_kegiatan,
                    'bentuk_kegiatan' => $request->bentuk_kegiatan,
                    'lokasi_kegiatan' => $request->lokasi_kegiatan,
                    'tglmulai' => $request->tglmulai,
                    'tglselesai' => $request->tglselesai,
                    'tingkat' => $request->tingkat,
                    'url' => $request->url,
                    'nohp' => $request->nohp,
                    'sumberdana' => $request->sumberdana,
                    'sumberdana1' => $request->sumberdana1,
                    'danalainnya' => $request->danalain,
                    'ajuandana' => $request->jumlah_dana,
                    'file_surat_undangan' => $file_surat_undangan,
                    'file_proposal' => $file_proposal
                    ]);  
                }
            } else if ($request->jenis_kegiatan=='lomba'){
                if ($request->sumberdana ==2 ) {
                $proposal->update([
                'jenis_proposal' => 'delegasi',
                'nama_kegiatan' => $request->nama_kegiatan,
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'bentuk_kegiatan' => $request->bentuk_kegiatan,
                'lokasi_kegiatan' => $request->lokasi_kegiatan,
                'tglmulai' => $request->tglmulai,
                'tglselesai' => $request->tglselesai,
                'tingkat' => $request->tingkat,
                'url' => $request->url,
                'nohp' => $request->nohp,
                'sumberdana' => $request->sumberdana,
                'sumberdana1' => $request->sumberdana1,
                'danalainnya' => $request->danalain,
                'departemen' => decrypt($request->departemen),
                'ajuandana' => $request->jumlah_dana,
                'file_surat_undangan' => $file_surat_undangan,
                'file_proposal' => $file_proposal
                ]);
                }
                else {
                    $proposal->update([
                    'jenis_proposal' => 'delegasi',
                    'jenis_rekognisi' => $request->jenis_rekognisi,    //disini yg membedakan nonlomba
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'jenis_kegiatan' => $request->jenis_kegiatan,
                    'bentuk_kegiatan' => $request->bentuk_kegiatan,
                    'lokasi_kegiatan' => $request->lokasi_kegiatan,
                    'tglmulai' => $request->tglmulai,
                    'tglselesai' => $request->tglselesai,
                    'tingkat' => $request->tingkat,
                    'url' => $request->url,
                    'nohp' => $request->nohp,
                    'sumberdana' => $request->sumberdana,
                    'sumberdana1' => $request->sumberdana1,
                    'danalainnya' => $request->danalain,
                    'ajuandana' => $request->jumlah_dana,
                    'file_surat_undangan' => $file_surat_undangan,
                    'file_proposal' => $file_proposal
                    ]);  
                }
            }

            return redirect()->back()
                ->with(['success' => 'berhasil duperbarui']);
        } catch (\Exception $e){
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    public function addAnggota(Request $request, $id_proposal)
    {
        //dd($request->all());
        $cekiddepeartemen = DB::Select(DB::raw("select id_departemen from jurusan where jurusan = '".$request->jurusan."' limit 1"));
       // dd($cekiddepeartemen[0]->id_departemen);
        $cekketua = DB::Select(DB::raw("select * from anggota_proposal where id_proposal =".$id_proposal." and jabatan = 'ketua'"));
        $ceknim = DB::Select(DB::raw("select * from anggota_proposal where id_proposal =".$id_proposal." and NIM = '".$request->nim."'"));

        if(count($cekketua)>0 && $request->jabatan=='ketua'){
            return redirect()->back()
                ->with(['error' => ' Ketua sudah ada, harap menambahkan dengan jabatan anggota']);
        }
        if(count($ceknim)>0){
            return redirect()->back()
                ->with(['error' => ' Mohon maaf NIM tersebut sudah ada di daftar anggota']);
        }

        try {

            $add = Anggota_proposal::create([
                'NIM' => $request->nim,
                'Nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'id_departemen' => $cekiddepeartemen[0]->id_departemen,
                'id_proposal' => $id_proposal
                
                ]);
            return redirect()->back()
                ->with(['success' => $add->Nama.' berhasil ditambahkan sebagai anggota']);
        } catch (\Exception $e){
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    public function hapusAnggota($id)
    {
        $di = decrypt($id);
        $anggota = Anggota_proposal::find($di);
        $anggota->delete();
        return redirect()->back()
                ->with(['success' => $anggota->Nama.' berhasil dihapus dari anggota']);
    }

    public function lihatDetail($id)
    {
        $di = decrypt($id);

        $data =  Proposal::find($di);
        $anggota= DB::select(DB::raw
                   ("SELECT a.id,NIM, Nama, jabatan, nama_departemen FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal=".$di." " ));
        $ketua= DB::select(DB::raw
                   ("SELECT a.id,NIM, Nama, jabatan, nama_departemen FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal=".$di." and a.jabatan = 'Ketua' " ));
        //dd(!empty($ketua));
        $lpj = LPJ::where('id_proposal', $di)->first();
        $departemen = Departemen::orderBy('id', 'ASC')->get();
        if(!isset($lpj)){
             $lengkap = false;
             $danacair = 0;
        }else if(isset($lpj)){
                if(substr($lpj->nomorproposal,0,2) == 'DL' || substr($lpj->nomorproposal,0,2) == 'DN')
                    {
                        
                        if(!isset($lpj->nomorproposal) || !isset($lpj->terlaksana) || !isset($lpj->capaian) || !isset($lpj->file_dokumentasi) || !isset($lpj->file_surat_tugas) || !isset($lpj->file_sertifikat) || !isset($lpj->file_reportase) || !isset($lpj->file_lpj)) 
                        {
                           $lengkap = false;
                           $danacair = $lpj->status;
                        }
                        if(isset($lpj->nomorproposal) && isset($lpj->terlaksana) && isset($lpj->capaian) && isset($lpj->file_dokumentasi) && isset($lpj->file_surat_tugas) && isset($lpj->file_sertifikat) && isset($lpj->file_reportase) && isset($lpj->file_lpj)) 
                        {
                           $lengkap = true;
                           $danacair = $lpj->status;
                        }
                    }
        }

        $status = json_decode (json_encode (
                                ["proposaldiajukan" => isset($data),
                                 "proposaldisetujui" => $data->status,
                                 "berkaslengkap" => $lengkap,
                                 "danacair" => $danacair,
                                 ]),false);
        
        return view('proposal.delegasi.detail', compact('data','anggota','ketua','lpj','departemen','status'));
    }

    public function hapus($id){

        // $proposal = Proposal::find($id)->delete();
        // $anggota = Anggota_proposal::where('id_proposal', $id)->delete();
        // $lpj = LPJ::where('id_proposal', $id)->delete();

        $proposal = Proposal::find($id);
        $proposal->update([
            'status' => 5,
            ]);

        $lpj = LPJ::where('id_proposal', $id);
        $lpj->update([
            'status' => 5,
        ]);

        return redirect()->back()
                ->with(['success' => ' proposal dihapus']);
    }

    public function editAdm($id){
        $data =  Proposal::find($id);
       // $anggota = Anggota_proposal::where('id_proposal',$id)->orderBy('jabatan', 'desc')->get();
        $anggota= DB::select(DB::raw
                   ("SELECT a.id,NIM, Nama, jabatan, nama_departemen FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal=".$id." " ));
        //dd($anggota);
        $departemen = Departemen::orderBy('id', 'ASC')->get();
        return view ('proposal.delegasi.editAdm', compact('data','anggota','departemen'));
    }

    public function updateAdm(Request $request, $id){
       
        
        $this->validate($request, [
            'jenis_kegiatan' => 'required|string',
            'nama_kegiatan' => 'required|string|max:100',
            'bentuk_kegiatan' => 'required|string|max:100',
            'tglmulai' => 'required',
            'tglselesai' => 'required',
            'tingkat' => 'required',
            'url' => 'required',
            'sumberdana' => 'nullable',
            'sumberdana1' => 'nullable',
            'jumlah_dana' => 'required',
            'file_surat_undangan' => 'nullable|mimes:pdf',
            'file_proposal' => 'nullable|mimes:pdf',

        ]);

        try {
            $proposal = Proposal::findOrFail($id);
            $file_surat_undangan = $proposal->file_surat_undangan;
            $file_proposal =$proposal->file_proposal;

            if ($request->hasFile('file_surat_undangan')) {
                !empty($file_surat_undangan) ? File::delete(public_path('storage/uploads/SuratUndangan/' . $file_surat_undangan)):null;
                $file_surat_undangan = $this->saveFileSurat($request->nama_kegiatan, $request->file('file_surat_undangan'));
            }

            if ($request->hasFile('file_proposal')) {
                !empty($file_sproposal) ? File::delete(public_path('storage/uploads/Proposal/' . $file_proposal)):null;
                $file_proposal = $this->saveFileProposal($request->nama_kegiatan, $request->file('file_proposal'));
            }

    
            if($request->jenis_kegiatan == 'nonlomba'){
                if ($request->sumberdana ==2 ) {
                $proposal->update([
                'jenis_proposal' => 'delegasi',
                'jenis_rekognisi' => $request->jenis_rekognisi,    //disini yg membedakan nonlomba
                'nama_kegiatan' => $request->nama_kegiatan,
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'bentuk_kegiatan' => $request->bentuk_kegiatan,
                'lokasi_kegiatan' => $request->lokasi_kegiatan,
                'tglmulai' => $request->tglmulai,
                'tglselesai' => $request->tglselesai,
                'tingkat' => $request->tingkat,
                'url' => $request->url,
                'nohp' => $request->nohp,
                'sumberdana' => $request->sumberdana,
                'sumberdana1' => $request->sumberdana1,
                'danalainnya' => $request->danalain,
                'departemen' => decrypt($request->departemen),               //disini yg membedakan jia milih departemen
                'ajuandana' => $request->jumlah_dana,
                'danadisetujui' => $request->danadisetujui,
                'file_surat_undangan' => $file_surat_undangan,
                'file_proposal' => $file_proposal
                ]);
                }else {
                    $proposal->update([
                    'jenis_proposal' => 'delegasi',
                    'jenis_rekognisi' => $request->jenis_rekognisi,    //disini yg membedakan nonlomba
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'jenis_kegiatan' => $request->jenis_kegiatan,
                    'bentuk_kegiatan' => $request->bentuk_kegiatan,
                    'lokasi_kegiatan' => $request->lokasi_kegiatan,
                    'tglmulai' => $request->tglmulai,
                    'tglselesai' => $request->tglselesai,
                    'tingkat' => $request->tingkat,
                    'url' => $request->url,
                    'nohp' => $request->nohp,
                    'sumberdana' => $request->sumberdana,
                    'sumberdana1' => $request->sumberdana1,
                    'danalainnya' => $request->danalain,
                    'ajuandana' => $request->jumlah_dana,
                    'danadisetujui' => $request->danadisetujui,
                    'file_surat_undangan' => $file_surat_undangan,
                    'file_proposal' => $file_proposal
                    ]);  
                }
            } else if ($request->jenis_kegiatan=='lomba'){
                if ($request->sumberdana ==2 ) {
                $proposal->update([
                'jenis_proposal' => 'delegasi',
                'nama_kegiatan' => $request->nama_kegiatan,
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'bentuk_kegiatan' => $request->bentuk_kegiatan,
                'lokasi_kegiatan' => $request->lokasi_kegiatan,
                'tglmulai' => $request->tglmulai,
                'tglselesai' => $request->tglselesai,
                'tingkat' => $request->tingkat,
                'url' => $request->url,
                'nohp' => $request->nohp,
                'sumberdana' => $request->sumberdana,
                'sumberdana1' => $request->sumberdana1,
                'danalainnya' => $request->danalain,
                'departemen' => decrypt($request->departemen),
                'ajuandana' => $request->jumlah_dana,
                'danadisetujui' => $request->danadisetujui,
                'file_surat_undangan' => $file_surat_undangan,
                'file_proposal' => $file_proposal
                ]);
                }
                else {
                    $proposal->update([
                    'jenis_proposal' => 'delegasi',
                    'jenis_rekognisi' => $request->jenis_rekognisi,    //disini yg membedakan nonlomba
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'jenis_kegiatan' => $request->jenis_kegiatan,
                    'bentuk_kegiatan' => $request->bentuk_kegiatan,
                    'lokasi_kegiatan' => $request->lokasi_kegiatan,
                    'tglmulai' => $request->tglmulai,
                    'tglselesai' => $request->tglselesai,
                    'tingkat' => $request->tingkat,
                    'url' => $request->url,
                    'nohp' => $request->nohp,
                    'sumberdana' => $request->sumberdana,
                    'sumberdana1' => $request->sumberdana1,
                    'danalainnya' => $request->danalain,
                    'ajuandana' => $request->jumlah_dana,
                    'danadisetujui' => $request->danadisetujui,
                    'file_surat_undangan' => $file_surat_undangan,
                    'file_proposal' => $file_proposal
                    ]);  
                }
            }

            return redirect()->back()
                ->with(['success' => 'berhasil duperbarui']);
        } catch (\Exception $e){
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
    
}
