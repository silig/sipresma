<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Mahasiswa;

class UserExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mahasiswa::all();
    }
}
