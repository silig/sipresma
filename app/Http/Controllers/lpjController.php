<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LPJ;
use App\Proposal;
use Random;
use File;

class lpjController extends Controller
{
    public function delegasi($id)
    {
    	$di = decrypt($id);
    	$lpj = LPJ::where('id_proposal', $di)->first();

    	return view('lpj.delegasi.index', compact('lpj'));
    }

    public function update(Request $request,$id){

        $this->validate($request, [
                        
            'file_proposal' => 'nullable|mimes:pdf|max:2000',
            'file_dokumentasi' => 'nullable|mimes:jpg,jpeg|max:2000',
            'file_dokumentasi1' => 'nullable|mimes:jpg,jpeg|max:2000',
            'file_dokumentasi2' => 'nullable|mimes:jpg,jpeg|max:2000',
            'file_surat_tugas' => 'nullable|mimes:pdf|max:2000',
            'sertifikat' => 'nullable|mimes:pdf|max:2000',
            'sertifikat1' => 'nullable|mimes:pdf|max:2000',
            'sertifikat2' => 'nullable|mimes:pdf|max:2000',
            'file_lpj' => 'nullable|mimes:pdf|max:2000',
            'file_daftar_pemenang' => 'nullable|mimes:pdf|max:2000',

        ]);

		try{


			$lpj = LPJ::findOrFail($id);
            $file_dokumentasi = $lpj->file_dokumentasi;
            $file_dokumentasi1 = $lpj->file_dokumentasi1;
            $file_dokumentasi2 = $lpj->file_dokumentasi2;
            $file_surattugas = $lpj->file_surat_tugas;
            $file_sertifikat = $lpj->file_sertifikat;
            $file_sertifikat1 = $lpj->file_sertifikat1;
            $file_sertifikat2 = $lpj->file_sertifikat2;
            $file_reportase = $lpj->file_reportase;
            $file_lpj = $lpj->file_lpj;
            $file_daftar_pemenang = $lpj->file_daftar_pemenang;

            $proposal = Proposal::findOrFail($lpj->id_proposal);
            


            if ($request->hasFile('file_dokumentasi')) {
                !empty($file_dokumentasi) ? File::delete(public_path('storage/uploads/Dokumentasi/' . $file_dokumentasi)):null;
                $file_dokumentasi = $this->saveFileDokumentasi($proposal->nama_kegiatan, $request->file('file_dokumentasi'));
            }
            if ($request->hasFile('file_dokumentasi1')) {
                !empty($file_dokumentasi1) ? File::delete(public_path('storage/uploads/Dokumentasi/' . $file_dokumentasi1)):null;
                $file_dokumentasi1 = $this->saveFileDokumentasi($proposal->nama_kegiatan, $request->file('file_dokumentasi1'));
            }
            if ($request->hasFile('file_dokumentasi2')) {
                !empty($file_dokumentasi2) ? File::delete(public_path('storage/uploads/Dokumentasi/' . $file_dokumentasi2)):null;
                $file_dokumentasi2 = $this->saveFileDokumentasi($proposal->nama_kegiatan, $request->file('file_dokumentasi2'));
            }

            if ($request->hasFile('file_surat_tugas')) {
                !empty($file_surattugas) ? File::delete(public_path('storage/uploads/SuratTugas/' . $file_surattugas)):null;
                $file_surattugas = $this->saveFileSuratTugas($proposal->nama_kegiatan, $request->file('file_surat_tugas'));
            }

            if ($request->hasFile('sertifikat')) {
                !empty($file_sertifikat) ? File::delete(public_path('storage/uploads/Sertifikat/' . $file_sertifikat)):null;
                $file_sertifikat = $this->saveFileSertifikat($proposal->nama_kegiatan, $request->file('sertifikat'));
            }
            if ($request->hasFile('sertifikat1')) {
                !empty($file_sertifikat1) ? File::delete(public_path('storage/uploads/Sertifikat/' . $file_sertifikat1)):null;
                $file_sertifikat1 = $this->saveFileSertifikat($proposal->nama_kegiatan, $request->file('sertifikat1'));
            }
            if ($request->hasFile('sertifikat2')) {
                !empty($file_sertifika2t) ? File::delete(public_path('storage/uploads/Sertifikat/' . $file_sertifikat2)):null;
                $file_sertifikat2 = $this->saveFileSertifikat($proposal->nama_kegiatan, $request->file('sertifikat2'));
            }

            if ($request->hasFile('reportase')) {
                !empty($file_reportase) ? File::delete(public_path('storage/uploads/Reportase/' . $file_reportase)):null;
                $file_reportase = $this->saveFileReportase($proposal->nama_kegiatan, $request->file('reportase'));
            }

            if ($request->hasFile('file_lpj')) {
                !empty($file_lpj) ? File::delete(public_path('storage/uploads/LPJ/' . $file_lpj)):null;
                $file_lpj = $this->saveFileLPJ($proposal->nama_kegiatan, $request->file('file_lpj'));
            }

            if ($request->hasFile('file_daftar_pemenang')) {
                !empty($file_daftar_pemenang) ? File::delete(public_path('storage/uploads/DaftarPemenang/' . $file_daftar_pemenang)):null;
                $file_daftar_pemenang = $this->saveFileDaftarPemenang($proposal->nama_kegiatan, $request->file('file_daftar_pemenang'));
            }


            // $proposal = Proposal::findOrFail($lpj->id_proposal);
            // dd($proposal->jenis_proposal);
            if($request->terlaksana == 'Tidak'){
                 $lpj->update([
                'terlaksana' => $request->terlaksana,
                'capaian' => null,
                'catatancapaian' => null,
                'jumlahpeserta_kegiatan' => null,
                'jmlnegara_peserta_lomba' => null,
                'jmluniv_peserta_lomba' => null,
                'jmlmahasiswa_peserta_lomba' => null,
                'url' => null,
                'file_dokumentasi' => null,
                'file_dokumentasi1' => null,
                'file_dokumentasi2' => null,
                'file_surat_tugas' => null, 
                'file_sertifikat' => null,
                'file_sertifikat1' => null,
                'file_sertifikat2' => null,
                'file_daftar_pemenang' => null,
                'file_reportase' => null,
                'file_lpj' => null,
                'status' => '3'
                ]);

                if (substr($lpj->nomorproposal,0,1) == 'P'){
                    return redirect(route('pengajuanku.penyelenggara'))->with(['success' => 'LPJ kegiatan menjadi tidak terlaksana']);
                }
                if (substr($lpj->nomorproposal,0,1) == 'D'){
                    return redirect(route('pengajuanku.delegasi'))->with(['success' => 'LPJ kegiatan menjadi tidak terlaksana']);
                }
            } else if($request->terlaksana == 'Ya'){
            $lpj->update([
            	'terlaksana' => $request->terlaksana,
            	'capaian' => $request->capaian,
            	'catatancapaian' => $request->catatancapaian,
                'jumlahpeserta_kegiatan' => $request->jumlahpeserta,
                'jmlnegara_peserta_lomba' => $request->jmlnegara_peserta_lomba,
                'jmluniv_peserta_lomba' => $request->jmluniv_peserta_lomba,
                'jmlmahasiswa_peserta_lomba' => $request->jmlmahasiswa_peserta_lomba,
            	'url' => $request->url,
                'file_dokumentasi' => $file_dokumentasi,
                'file_dokumentasi1' => $file_dokumentasi1,
            	'file_dokumentasi2' => $file_dokumentasi2,
            	'file_surat_tugas' => $file_surattugas, 
                'file_sertifikat' => $file_sertifikat,
                'file_sertifikat1' => $file_sertifikat1,
            	'file_sertifikat2' => $file_sertifikat2,
                'file_daftar_pemenang' => $file_daftar_pemenang,
            	'file_reportase' => $file_reportase,
            	'file_lpj' => $file_lpj
            	]);

            return redirect()->back()
                ->with(['success' => 'berhasil dsimpan']);
            }

			
        } catch(\Exception $e){
        		return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }    


    }

    public function penyelenggara($id)
    {
        $di = decrypt($id);
        $lpj = LPJ::where('id_proposal', $di)->first();

        return view('lpj.penyelenggara.index', compact('lpj'));
    }


























    private function saveFileDokumentasi($name, $surat)
    {
        
        $surat1 = 'Dok-'.str_slug($name) . time() . '.' . $surat->getClientOriginalExtension();
        $path = Storage_path('App/public/uploads/Dokumentasi');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        $surat->storeas('public/uploads/Dokumentasi',$surat1);
        //Storage::make($surat)->save($path . '/' . $surat1); 
        //Image::make($photo)->save($path . '/' . $images);
        return $surat1;
    }
    private function saveFileSuratTugas($name, $surat)
    {
        
        $surat1 = 'Surat-Tugas-'.str_slug($name) . time() . '.' . $surat->getClientOriginalExtension();
        $path = Storage_path('App/public/uploads/SuratTugas');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        $surat->storeas('public/uploads/SuratTugas',$surat1);
        //Storage::make($surat)->save($path . '/' . $surat1); 
        //Image::make($photo)->save($path . '/' . $images);
        return $surat1;
    }
    private function saveFileSertifikat($name, $surat)
    {
        
        $surat1 = 'Sertifikat-'.str_slug($name) . time() . '.' . $surat->getClientOriginalExtension();
        $path = Storage_path('App/public/uploads/Sertifikat');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        $surat->storeas('public/uploads/Sertifikat',$surat1);
        //Storage::make($surat)->save($path . '/' . $surat1); 
        //Image::make($photo)->save($path . '/' . $images);
        return $surat1;
    }
    private function saveFileReportase($name, $surat)
    {
        
        $surat1 = 'Reportase-'.str_slug($name) . time() . '.' . $surat->getClientOriginalExtension();
        $path = Storage_path('App/public/uploads/Reportase');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        $surat->storeas('public/uploads/Reportase',$surat1);
        //Storage::make($surat)->save($path . '/' . $surat1); 
        //Image::make($photo)->save($path . '/' . $images);
        return $surat1;
    }
    private function saveFileLPJ($name, $surat)
    {
        
        $surat1 = 'LPJ-'.str_slug($name) . time() . '.' . $surat->getClientOriginalExtension();
        $path = Storage_path('App/public/uploads/LPJ');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        $surat->storeas('public/uploads/LPJ',$surat1);
        //Storage::make($surat)->save($path . '/' . $surat1); 
        //Image::make($photo)->save($path . '/' . $images);
        return $surat1;
    }
    private function saveFileDaftarPemenang($name, $surat)
    {
        
        $surat1 = 'DafatarPemenang-'.str_slug($name) . time() . '.' . $surat->getClientOriginalExtension();
        $path = Storage_path('App/public/uploads/DaftarPemenang');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        $surat->storeas('public/uploads/DaftarPemenang',$surat1);
        //Storage::make($surat)->save($path . '/' . $surat1); 
        //Image::make($photo)->save($path . '/' . $images);
        return $surat1;
    }
}
