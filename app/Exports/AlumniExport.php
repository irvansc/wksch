<?php

namespace App\Exports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlumniExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;
    public function headings():array
    {
        return [
            '#ID',
            'NAMA LENGKAP',
            'NIS',
            'TAHUN LULUS',
            'TAHUN MASUK',
            'TGL LAHIR',
            'EMAIL',
            'WHATSAAP',
            'ALAMAT',
        ];
    }
    public function map($alumni):array
    {
        return [
            $alumni->id,
            $alumni->name,
            $alumni->nis,
            $alumni->thn_lulus,
            $alumni->thn_masuk,
            $alumni->tgl_lahir,
            $alumni->email,
            $alumni->telp,
            $alumni->alamat,
        ];
    }

    public function collection()
    {
        // return Alumni::whereIn('id', $this->mySelected);

        return Alumni::all();
    }
    /**
    * @return \Illuminate\Support\Collection
    */

}
