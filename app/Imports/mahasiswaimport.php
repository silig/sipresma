<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Mahasiswa;
use App\User;
use App\Jurusan;

class mahasiswaimport implements ToCollection, WithBatchInserts,WithChunkReading
{
    /**
    * @param Collection $collection
    */
    private $hitung = 0;

    public function collection(Collection $collection)
    {
    	
        foreach ($collection as $row){
        	$jurusan = Jurusan::where('kode', $row[3])->first();
        	$cek = Mahasiswa::where('NIM', $row[0])->first();
        	if(isset($cek)){
        		echo 'hanya lewat';
        	}
        	else {
	        	$user = User::create([
	        		'NIM' => $row[0],
	        		'username' => $row[0],
	        		'password' => bcrypt($row[0]),
	        		'status' => 1,
	        		]);
	        	$user->find($user->id)->syncRoles('mahasiswa');

	        	Mahasiswa::create([
	        		'NIM' => $row[0],
	        		'nama_mhs' => $row[1],
	        		'id_departemen' => $jurusan->id_departemen,
	        		'id_user' => $user->id,
	        		'id_jurusan' => $jurusan->id,
	        		'angkatan' => $row[2]
	        		]);

	        	++$this->hitung;
        	}
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }
    
    public function chunkSize(): int
    {
        return 1000;
    }

    public function getCount(): int {
    	return $this->hitung;
    }
}
