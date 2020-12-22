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

class ProposalPenyelenggaraController extends Controller
{
    public function index()
    {
        //untuk memfilter 14 hari sebelum today
        // $wingi = Carbon::now()->subDays(14)->toDateTimeString();
        // $now = Carbon::now()->toDateTimeString();
        $hari_ini = date("Y-m-d");
        $wingi = date('Y-m-01', strtotime($hari_ini));
        $now = date('Y-m-t', strtotime($hari_ini));

        
        // $proposal = DB::select(DB::raw
        //           ("select * from proposal where jenis_proposal='delegasi' order by id desc"));
        $proposal = DB::select(DB::raw
                  ("select * from proposal where jenis_proposal='penyelenggara' and created_at BETWEEN '".$wingi."' and '".$now."'"));
        
        $departemen = Departemen::orderBy('id', 'ASC')->get();
        return view('proposal.penyelenggara.index', compact('proposal','wingi','now','departemen'));
    }

     public function cari(Request $request)
    {

        $wingi = $request->awal;
        $now = $request->akhir;
        
        $proposal = DB::select(DB::raw
                  ("select * from proposal where jenis_proposal='penyelenggara' and created_at BETWEEN '".$wingi."' and '".$now."' order by created_at "));
        $departemen = Departemen::orderBy('id', 'ASC')->get();

        return view('proposal.penyelenggara.index', compact('proposal','wingi','now','departemen'));
    }

    public function create()
    {
        $departemen = Departemen::orderBy('id', 'ASC')->get();

    	return view('proposal.penyelenggara.create', compact('departemen'));
    }

    public function store(Request $request)
    {

    	ini_set("max_execution_time", (60 *60 *3)); // 3 hours
        ini_set("memory_limit", "40M");
        ini_set("post_max_size","15M");
        ini_set("upload_max_filesize","15M");
       
        $this->validate($request, [
            'jenis_kegiatan' => 'required|string',
            'nama_kegiatan' => 'required|string|max:100',
            "penyelenggara_kegiatan" => 'required|string|max:100',
            'bentuk_kegiatan' => 'required|string|max:100',
            'sasaran_kegiatan' => 'required|string|max:100',
            'tglmulai' => 'required',
            'tglselesai' => 'required',
            'lokasi_kegiatan' => 'required',
            'url' => 'required',
            'nohp' => 'required|numeric',
            'sumberdana' => 'required',
            'sumberdana1' => 'nullable',
            'jumlah_dana' => 'required',
            'file_proposal' => 'required|mimes:pdf|max:2000',
        ], [
            'jenis_kegiatan.required' => 'Jenis Kegiatan tidak boleh kosong',
            'nama_kegiatan.required' => 'Nama Kegiatan tidak boleh kosong',
            'bentuk_kegiatan.required' => 'Bentuk Kegiatan tidak boleh kosong',
            'bpenyelenggara_kegiatan.required' => 'Penyelenggara Kegiatan tidak boleh kosong',
            'tglmulai.required' => 'Tanggal mulai tidak boleh kosong',
            'tglselesai.required' => 'Tanggal selesai tidak boleh kosong',
            'lokasi_kegiatan.required' => 'Lokasi kegiatan tidak boleh kosong',
            'tingkat.required' => 'Tingkat tidak boleh kosong',
            'nohp.required' => 'no hp tidak boleh kosong',
            'nohp.numeric' => 'Harus angka',
            'url.required' => 'Url tidak boleh kosong',
            'jumlah_dana.required' => 'Jumlah dana tidak boleh kosong',
            'file_proposal.required' => 'File Proposal tidak boleh kosong',
            'file_proposal.mimes' => 'File Surat Undangan Harus berformat .pdf',
            'file_proposal.max' => 'Ukuran File Proposal maksimal 2MB',
        ]);

        if($request->penyelenggara_kegiatan == 'UPK'){
        $unit = $request->unit_kegiatan_upk; 
        }else if ($request->penyelenggara_kegiatan == 'Himpunan'){
        $unit = $request->unit_kegiatan_hmj;   
        } else {
            $unit = null;
        }

        try {
            $tahun = date('Y');
            $jmlhlomba = DB::Select(DB::raw("select * from proposal where jenis_proposal = 'penyelenggara' and jenis_kegiatan='lomba' and created_at like '%".$tahun."%' "));
            $jmlhsoftskill = DB::Select(DB::raw("select * from proposal where jenis_proposal = 'penyelenggara' and jenis_kegiatan='softskill' and created_at like '%".$tahun."%' "));
            $jmlhlainnya = DB::Select(DB::raw("select * from proposal where jenis_proposal = 'penyelenggara' and jenis_kegiatan='lainnya' and created_at like '%".$tahun."%' "));
            $numberlomba = str_pad(count($jmlhlomba)+1, 3, '0', STR_PAD_LEFT);
            $numberlainnya = str_pad(count($jmlhlainnya)+1, 3, '0', STR_PAD_LEFT);
            $numbersoftskill = str_pad(count($jmlhsoftskill)+1, 3, '0', STR_PAD_LEFT);

            $file_proposal = null;
            if ($request->hasFile('file_proposal')) {
                $file_proposal = $this->saveFileProposal($request->namakegiatan, $request->file('file_proposal')); 
            } 
            
            //jika memilih departemen
            if($request->sumberdana == 2){
                if ($request->jenis_kegiatan == 'lomba'){
                    $proposal = Proposal::create([
                    'jenis_proposal' => 'penyelenggara',
                    'nomor_proposal' => 'PL'.$numberlomba,
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'jenis_kegiatan' => $request->jenis_kegiatan,
                    'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                    'unit_kegiatan' => $unit,
                    'bentuk_kegiatan' => $request->bentuk_kegiatan,
                    'sasaran_kegiatan' => $request->sasaran_kegiatan,
                    'tglmulai' => $request->tglmulai,
                    'tglselesai' => $request->tglselesai,
                    'tingkat' => $request->tingkat,
                    'nohp' => $request->nohp,
                    'lokasi_kegiatan' => $request->lokasi_kegiatan,
                    'url' => $request->url,
                    'sumberdana' => $request->sumberdana,
                    'departemen' => decrypt($request->departemen),
                    'sumberdana1' => $request->sumberdana1,
                    'ajuandana' => $request->jumlah_dana,
                    'file_proposal' => $file_proposal,
                    'status' => 0
                    ]);
                }elseif($request->jenis_kegiatan == 'softskill'){
                    $proposal = Proposal::create([
                    'jenis_proposal' => 'penyelenggara',
                    'nomor_proposal' => 'PS'.$numbersoftskill,
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'jenis_kegiatan' => $request->jenis_kegiatan,
                    'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                    'unit_kegiatan' => $unit,
                    'bentuk_kegiatan' => $request->bentuk_kegiatan,
                    'sasaran_kegiatan' => $request->sasaran_kegiatan,
                    'tglmulai' => $request->tglmulai,
                    'tglselesai' => $request->tglselesai,
                    'lokasi_kegiatan' => $request->lokasi_kegiatan,
                    'url' => $request->url,
                    'nohp' => $request->nohp,
                    'sumberdana' => $request->sumberdana,
                    'departemen' => decrypt($request->departemen),
                    'sumberdana1' => $request->sumberdana1,
                    'ajuandana' => $request->jumlah_dana,
                    'file_proposal' => $file_proposal,
                    'status' => 0
                    ]);
                }elseif($request->jenis_kegiatan == 'lainnya'){
                    $proposal = Proposal::create([
                    'jenis_proposal' => 'penyelenggara',
                    'nomor_proposal' => 'PU'.$numberlainnya,
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'jenis_kegiatan' => $request->jenis_kegiatan,
                    'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                    'unit_kegiatan' => $unit,
                    'bentuk_kegiatan' => $request->bentuk_kegiatan,
                    'sasaran_kegiatan' => $request->sasaran_kegiatan,
                    'tglmulai' => $request->tglmulai,
                    'tglselesai' => $request->tglselesai,
                    'lokasi_kegiatan' => $request->lokasi_kegiatan,
                    'url' => $request->url,
                    'nohp' => $request->nohp,
                    'sumberdana' => $request->sumberdana,
                    'departemen' => decrypt($request->departemen),
                    'sumberdana1' => $request->sumberdana1,
                    'ajuandana' => $request->jumlah_dana,
                    'file_proposal' => $file_proposal,
                    'status' => 0
                    ]);
                }

            //jika memilih fakultas
            } elseif($request->sumberdana == 1){
                
                if ($request->jenis_kegiatan == 'lomba'){
                    
                    $proposal = Proposal::create([
                    'jenis_proposal' => 'penyelenggara',
                    'nomor_proposal' => 'PL'.$numberlomba,
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'jenis_kegiatan' => $request->jenis_kegiatan,
                    'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                    'unit_kegiatan' => $unit,
                    'bentuk_kegiatan' => $request->bentuk_kegiatan,
                    'sasaran_kegiatan' => $request->sasaran_kegiatan,
                    'tglmulai' => $request->tglmulai,
                    'tglselesai' => $request->tglselesai,
                    'tingkat' => $request->tingkat,
                    'nohp' => $request->nohp,
                    'lokasi_kegiatan' => $request->lokasi_kegiatan,
                    'url' => $request->url,
                    'sumberdana' => $request->sumberdana,
                    'departemen' => 99,
                    'sumberdana1' => $request->sumberdana1,
                    'ajuandana' => $request->jumlah_dana,
                    'file_proposal' => $file_proposal,
                    'status' => 0
                    ]);
                }elseif($request->jenis_kegiatan == 'softskill'){
                    $proposal = Proposal::create([
                    'jenis_proposal' => 'penyelenggara',
                    'nomor_proposal' => 'PS'.$numbersoftskill,
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'jenis_kegiatan' => $request->jenis_kegiatan,
                    'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                    'unit_kegiatan' => $unit,
                    'bentuk_kegiatan' => $request->bentuk_kegiatan,
                    'sasaran_kegiatan' => $request->sasaran_kegiatan,
                    'tglmulai' => $request->tglmulai,
                    'tglselesai' => $request->tglselesai,
                    'lokasi_kegiatan' => $request->lokasi_kegiatan,
                    'url' => $request->url,
                    'nohp' => $request->nohp,
                    'sumberdana' => $request->sumberdana,
                    'departemen' => 99,
                    'sumberdana1' => $request->sumberdana1,
                    'ajuandana' => $request->jumlah_dana,
                    'file_proposal' => $file_proposal,
                    'status' => 0
                    ]);
                }elseif($request->jenis_kegiatan == 'lainnya'){

                    
                    $proposal = Proposal::create([
                    'jenis_proposal' => 'penyelenggara',
                    'nomor_proposal' => 'PU'.$numberlainnya,
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'jenis_kegiatan' => $request->jenis_kegiatan,
                    'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                    'unit_kegiatan' => $unit,
                    'bentuk_kegiatan' => $request->bentuk_kegiatan,
                    'sasaran_kegiatan' => $request->sasaran_kegiatan,
                    'tglmulai' => $request->tglmulai,
                    'tglselesai' => $request->tglselesai,
                    'lokasi_kegiatan' => $request->lokasi_kegiatan,
                    'url' => $request->url,
                    'nohp' => $request->nohp,
                    'sumberdana' => $request->sumberdana,
                    'departemen' => 99,
                    'sumberdana1' => $request->sumberdana1,
                    'ajuandana' => $request->jumlah_dana,
                    'file_proposal' => $file_proposal,
                    'status' => 0
                    ]);
                }
            }
            
            
            if (isset(UserHelp::datauser()[0]->NIM)){
            $anggota = Anggota_proposal::create([
                'NIM' => UserHelp::datauser()[0]->NIM,
                'Nama' => UserHelp::datauser()[0]->nama_mhs,
                'jabatan' => 'bendahara',
                'id_departemen' => UserHelp::datauser()[0]->id_departemen,
                'id_proposal' => $proposal->id
                ]);
            }

            return redirect(route('penyelenggara.edit', encrypt($proposal->id)))
                ->with(['success' => 'Proposal <strong>' . $proposal->nama_kegiatan . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
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
      
        $anggota= DB::select(DB::raw
                   ("SELECT a.id,NIM, Nama, jabatan, nama_departemen FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal=".$di." " ));
        
        $departemen = Departemen::orderBy('id', 'ASC')->get();
        return view ('proposal.penyelenggara.edit', compact('data','anggota','departemen'));
    }

    public function update(Request $request, $id){
        
        $di = decrypt($id);
        $this->validate($request, [
            'jenis_kegiatan' => 'required|string',
            'nama_kegiatan' => 'required|string|max:100',
            "penyelenggara_kegiatan" => 'required|string|max:100',
            'bentuk_kegiatan' => 'required|string|max:100',
            'sasaran_kegiatan' => 'required|string|max:100',
            'tglmulai' => 'required',
            'tglselesai' => 'required',
            'lokasi_kegiatan' => 'required',
            'url' => 'required',
            'sumberdana' => 'nullable',
            'sumberdana1' => 'nullable',
            'jumlah_dana' => 'required',
            'file_proposal' => 'nullable|mimes:pdf|max:2000',

        ]);

        //dd($request->file('file_proposal'), $request->hasFile('file_proposal'));
        if($request->penyelenggara_kegiatan == 'UPK'){
        $unit = $request->unit_kegiatan_upk; 
        }else if ($request->penyelenggara_kegiatan == 'Himpunan'){
        $unit = $request->unit_kegiatan_hmj;   
        } else {
            $unit = null;
        }

        try {

            $proposal = Proposal::findOrFail($di);
            $file_proposal1 =$proposal->file_proposal;
            
            if ($request->hasFile('file_proposal')) {
                !empty($file_proposal1) ? File::delete(public_path('storage/uploads/Proposal/' . $file_proposal1)):null;
                $file_proposal1 = $this->saveFileProposal($request->nama_kegiatan, $request->file('file_proposal'));
            }

            if($request->sumberdana == 2){
                $proposal->update([
                'jenis_proposal' => 'penyelenggara',
                'nama_kegiatan' => $request->nama_kegiatan,
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                'unit_kegiatan' => $unit,
                'bentuk_kegiatan' => $request->bentuk_kegiatan,
                'sasaran_kegiatan' => $request->sasaran_kegiatan,
                'tglmulai' => $request->tglmulai,
                'tglselesai' => $request->tglselesai,
                'lokasi_kegiatan' => $request->lokasi_kegiatan,
                'url' => $request->url,
                'sumberdana' => $request->sumberdana,
                'departemen' => decrypt($request->departemen),
                'sumberdana1' => $request->sumberdana1,
                'ajuandana' => $request->jumlah_dana,
                'file_proposal' => $file_proposal1
                ]);
            } elseif($request->sumberdana == 1){
                 $proposal->update([
                'jenis_proposal' => 'penyelenggara',
                'nama_kegiatan' => $request->nama_kegiatan,
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                'unit_kegiatan' => $unit,
                'bentuk_kegiatan' => $request->bentuk_kegiatan,
                'sasaran_kegiatan' => $request->sasaran_kegiatan,
                'tglmulai' => $request->tglmulai,
                'tglselesai' => $request->tglselesai,
                'lokasi_kegiatan' => $request->lokasi_kegiatan,
                'url' => $request->url,
                'sumberdana' => $request->sumberdana,
                'departemen' => 99,
                'sumberdana1' => $request->sumberdana1,
                'ajuandana' => $request->jumlah_dana,
                'file_proposal' => $file_proposal1
                ]);
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
        $cekketua = DB::Select(DB::raw("select * from anggota_proposal where id_proposal =".$id_proposal." and jabatan = 'bendahara'"));
        $ceknim = DB::Select(DB::raw("select * from anggota_proposal where id_proposal =".$id_proposal." and NIM = '".$request->nim."'"));

        if(count($cekketua)>0 && $request->jabatan=='bendahara'){
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
                   ("SELECT a.id,NIM, Nama, jabatan, nama_departemen FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal=".$di." and a.jabatan = 'bendahara' " ));
        //dd(!empty($ketua));
        $lpj = LPJ::where('id_proposal', $di)->first();
        
        $departemen = Departemen::orderBy('id', 'ASC')->get();

        if(!isset($lpj)){
             $lengkap = false;
             $danacair = 0;
        }else if(isset($lpj)){
            if(substr($lpj->nomorproposal,0,2) == 'PU' || substr($lpj->nomorproposal,0,2) == 'PS')
            {
                
                if(isset($lpj->nomorproposal) && isset($lpj->terlaksana) && isset($lpj->jumlahpeserta_kegiatan) && isset($lpj->file_dokumentasi) && isset($lpj->file_reportase) && isset($lpj->file_lpj))
                {
                    $lengkap = true;
                    $danacair = $lpj->status;
                }
                if(!isset($lpj->nomorproposal) || !isset($lpj->terlaksana) || !isset($lpj->jumlahpeserta_kegiatan) || !isset($lpj->file_dokumentasi) || !isset($lpj->file_reportase) || !isset($lpj->file_lpj))
                {
                    $lengkap = false;
                    $danacair = $lpj->status;
                }
            }
            if(substr($lpj->nomorproposal,0,2) == 'PL')
            {
                
                if(isset($lpj->nomorproposal) && isset($lpj->terlaksana) && isset($lpj->jmlnegara_peserta_lomba) && isset($lpj->jmluniv_peserta_lomba) && isset($lpj->jmlmahasiswa_peserta_lomba) && isset($lpj->file_dokumentasi) && isset($lpj->file_daftar_pemenang) && isset($lpj->file_reportase) && isset($lpj->file_lpj))
                {
                    $lengkap = true;
                    $danacair = $lpj->status;
                }
                if(!isset($lpj->nomorproposal) || !isset($lpj->terlaksana) || !isset($lpj->jmlnegara_peserta_lomba) || !isset($lpj->jmluniv_peserta_lomba) || !isset($lpj->jmlmahasiswa_peserta_lomba) || !isset($lpj->file_dokumentasi) || !isset($lpj->file_daftar_pemenang) || !isset($lpj->file_reportase) || !isset($lpj->file_lpj))
                {
                   $lengkap = false;
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
            
        return view('proposal.penyelenggara.detail', compact('data','anggota','ketua','lpj','departemen','status'));
    }


    public function editAdm($id){
        $data =  Proposal::find($id);
       // $anggota = Anggota_proposal::where('id_proposal',$id)->orderBy('jabatan', 'desc')->get();
        $anggota= DB::select(DB::raw
                   ("SELECT a.id,NIM, Nama, jabatan, nama_departemen FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal=".$id." " ));
        //dd($anggota);
        $departemen = Departemen::orderBy('id', 'ASC')->get();
        return view ('proposal.penyelenggara.editAdm', compact('data','anggota','departemen'));
    }

    public function updateAdm(Request $request, $id){
        
        $this->validate($request, [
            'jenis_kegiatan' => 'required|string',
            'nama_kegiatan' => 'required|string|max:100',
            "penyelenggara_kegiatan" => 'required|string|max:100',
            'bentuk_kegiatan' => 'required|string|max:100',
            'sasaran_kegiatan' => 'required|string|max:100',
            'tglmulai' => 'required',
            'tglselesai' => 'required',
            'lokasi_kegiatan' => 'required',
            'url' => 'required',
            'sumberdana' => 'nullable',
            'sumberdana1' => 'nullable',
            'jumlah_dana' => 'required',
            'file_proposal' => 'nullable|mimes:pdf|max:2000',

        ]);

        //dd($request->file('file_proposal'), $request->hasFile('file_proposal'));
        if($request->penyelenggara_kegiatan == 'UPK'){
        $unit = $request->unit_kegiatan_upk; 
        }else if ($request->penyelenggara_kegiatan == 'Himpunan'){
        $unit = $request->unit_kegiatan_hmj;   
        } else {
            $unit = null;
        }

        try {

            $proposal = Proposal::findOrFail($id);
            $file_proposal1 =$proposal->file_proposal;
            
            if ($request->hasFile('file_proposal')) {
                !empty($file_proposal1) ? File::delete(public_path('storage/uploads/Proposal/' . $file_proposal1)):null;
                $file_proposal1 = $this->saveFileProposal($request->nama_kegiatan, $request->file('file_proposal'));
            }

            if($request->sumberdana == 2){
                $proposal->update([
                'jenis_proposal' => 'penyelenggara',
                'nama_kegiatan' => $request->nama_kegiatan,
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                'unit_kegiatan' => $unit,
                'bentuk_kegiatan' => $request->bentuk_kegiatan,
                'sasaran_kegiatan' => $request->sasaran_kegiatan,
                'tglmulai' => $request->tglmulai,
                'tglselesai' => $request->tglselesai,
                'lokasi_kegiatan' => $request->lokasi_kegiatan,
                'url' => $request->url,
                'sumberdana' => $request->sumberdana,
                'departemen' => decrypt($request->departemen),
                'sumberdana1' => $request->sumberdana1,
                'ajuandana' => $request->jumlah_dana,
                'danadisetujui' => $request->danadisetujui,
                'file_proposal' => $file_proposal1
                ]);
            } elseif($request->sumberdana == 1){
                 $proposal->update([
                'jenis_proposal' => 'penyelenggara',
                'nama_kegiatan' => $request->nama_kegiatan,
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'penyelenggara_kegiatan' => $request->penyelenggara_kegiatan,
                'unit_kegiatan' => $unit,
                'bentuk_kegiatan' => $request->bentuk_kegiatan,
                'sasaran_kegiatan' => $request->sasaran_kegiatan,
                'tglmulai' => $request->tglmulai,
                'tglselesai' => $request->tglselesai,
                'lokasi_kegiatan' => $request->lokasi_kegiatan,
                'url' => $request->url,
                'sumberdana' => $request->sumberdana,
                'departemen' => 99,
                'sumberdana1' => $request->sumberdana1,
                'ajuandana' => $request->jumlah_dana,
                'danadisetujui' => $request->danadisetujui,
                'file_proposal' => $file_proposal1
                ]);
            }

            return redirect()->back()
                ->with(['success' => 'berhasil duperbarui']);
        } catch (\Exception $e){
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
}
