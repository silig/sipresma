<?php
namespace App\Helpers;
use Carbon\Carbon;
class TanggalIndo
{
	public static function Indo($tgl)
	{
		$dt = new Carbon($tgl);
		setlocale(LC_TIME, 'IND');
		
		return $dt->formatLocalized('%d %B %Y');
	} 
}