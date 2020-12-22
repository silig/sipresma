<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
	protected $table = "proposal";
    protected $guarded = [];
    // protected $fillable = [
    //     'id', 'nomor_proposal', 'jenis_proposal','nama_kegiatan',
    //     'jenis_kegiatan', 'bentuk_kegiatan', 'penyelenggara_kegiatan','sasaran_kegiatan',
    //     'tglmulai', 'tglselesai', 'lokasi_kegiatan','tingkat',
    //     'url', 'sumberdana', 'sumberdana1','ajuandana',
    //      'file_surat_undangan', 'file_proposal', 'status','menyetujui','danadisetujui','keterangan'
    // ];
}
