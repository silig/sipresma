<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $guarded =[];

    public static function getData($id=0){

    	if($id == 0 ){
    		$value = DB::table('mahasiswa')->orderBy('id', 'asc')->get();
    	} else {
    		$value = DB::table('mahasiswa')->where('id', $id)->first();
    	}

    	return $value;
    }
}

