<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromCollection,WithMapping, WithHeadings
{
    use  Importable;
    public function headings():array
    {
        return [
            '#ID',
            '#KELAS_ID',
            'NAMA LENGKAP',
            'NIS',
            'JENKEL',
            'TGL LAHIR',
            'ALAMAT',
        ];
    }
    public function map($siswa):array
    {
        return [
            $siswa->id,
            $siswa->kelas_id,
            $siswa->name,
            $siswa->nis,
            $siswa->jenkel,
            $siswa->tgl_lahir,
            $siswa->alamat,
        ];
    }

    public function collection()
    {
        // return siswa::whereIn('id', $this->mySelected);

        return Siswa::all();
    }
}
