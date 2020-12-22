<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Response;


class ViewPDF {

    public static function proposal($file) {
    	
       $path = Storage_path('App/public/uploads/Proposal/');
       $pathToFile = $path.$file;
       return response()->file($pathToFile);
    }
    
    public static function suratundangan($file) {
      
       $path = Storage_path('App/public/uploads/SuratUndangan/');
       $pathToFile = $path.$file;
       return response()->file($pathToFile);
    }
}