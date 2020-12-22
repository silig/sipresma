<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota_proposal extends Model
{
    protected $table = 'anggota_proposal';

    protected $fillable = ['NIM','Nama','jabatan','id_proposal','id_departemen'];
}
