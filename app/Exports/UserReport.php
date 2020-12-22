<?php

namespace App\Exports;
use App\Mahasiswa;
​use Maatwebsite\Excel\Concerns\FromCollection;
​
class UserReport implements FromCollection
{
    public function collection()
    {
        return Mahasiswa::all();
    }
}