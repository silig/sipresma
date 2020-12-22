<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Auth;
use Tanggal;

class random {

    public static function acak() {
    	
      	 $karakter = 'QWERTASDFGZXCVMNBLKJHPOIUY1234567890';
      	 $string = [];

      	 for($i = 0;$i < 11; $i++){

      	 	$pos = rand(0, strlen($karakter)-1);
      	 	$string .= $karakter[$pos];
      	 }

      	 return $string;
    }

    public static function jam(){
    
    $hari = date ("D");
 
    switch($hari){
      case 'Sun':
        $hari_ini = "Minggu";
      break;
   
      case 'Mon':     
        $hari_ini = "Senin";
      break;
   
      case 'Tue':
        $hari_ini = "Selasa";
      break;
   
      case 'Wed':
        $hari_ini = "Rabu";
      break;
   
      case 'Thu':
        $hari_ini = "Kamis";
      break;
   
      case 'Fri':
        $hari_ini = "Jumat";
      break;
   
      case 'Sat':
        $hari_ini = "Sabtu";
      break;
      
      default:
        $hari_ini = "Tidak di ketahui";   
      break;
    }

    $tanggal = mktime(date('m'), date("d"), date('Y'));
    echo    $hari_ini.", " . Tanggal::indo(date("d-m-Y", $tanggal )) . "</b>";
    date_default_timezone_set("Asia/Jakarta");
    $jam = date ("H:i:s");
    echo "&nbsp;&nbsp;&nbsp;<a id='jam'></a><a>:</a>
            <a id='menit'></a><a>:</a>
            <a id='detik'></a> " ." ";
    $a = date ("H");
    if (($a>=6) && ($a<=11)) {
        echo " <b>, Selamat Pagi  </b>";
    }else if(($a>=11) && ($a<=15)){
        echo " ,<b> Selamat  Siang  </b>";
    }elseif(($a>=15) && ($a<=18)){
        echo ",<b> Selamat Sore </b>";
    }else{
        echo ", <b> Selamat Malam </b>";
    }
 
    }

  public static function hari_ini(){
  $hari = date ("D");
 
  switch($hari){
    case 'Sun':
      $hari_ini = "Minggu";
    break;
 
    case 'Mon':     
      $hari_ini = "Senin";
    break;
 
    case 'Tue':
      $hari_ini = "Selasa";
    break;
 
    case 'Wed':
      $hari_ini = "Rabu";
    break;
 
    case 'Thu':
      $hari_ini = "Kamis";
    break;
 
    case 'Fri':
      $hari_ini = "Jumat";
    break;
 
    case 'Sat':
      $hari_ini = "Sabtu";
    break;
    
    default:
      $hari_ini = "Tidak di ketahui";   
    break;
  }
 
  return $hari_ini;
 
  }
}