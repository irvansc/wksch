<?php

namespace App\Exports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GuruExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;
    public function headings():array
    {
        return [
            '#ID',
            'NAMA LENGKAP',
            'NIP',
            'GTK',
            'TGL LAHIR',
            'ALAMAT',
        ];
    }
    public function map($guru):array
    {
        return [
            $guru->id,
            $guru->name,
            $guru->nip,
            $guru->gtk,
            $guru->tgl_lahir,
            $guru->alamat,
        ];
    }

    public function collection()
    {
        return Guru::all();
    }
}
