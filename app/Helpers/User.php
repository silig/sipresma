<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Auth;


class User {

    public static function datauser() {
    	
      	 $id = Auth::user()->id; 
		 $data = DB::select(DB::raw
                   ("select b.nama_mhs, b.NIM, a.username, b.id_departemen from users a
					 inner join mahasiswa b on a.id = b.id_user
					 where a.id =".$id." "));
		 
		 if(count($data)>0){
		 	$hasil = $data;
		 } else {
		 	$hasil = Auth::user();
		 }
		 
		return $hasil;
    }
}