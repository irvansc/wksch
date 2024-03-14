<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;

class SiswaImportTemplate implements FromCollection,Responsable, ShouldAutoSize, WithHeadings, WithStrictNullComparison, WithTitle
{
    use Exportable;

    private $writerType =  \Maatwebsite\Excel\Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function __construct(string $type)
    {
        $this->type = $type;
        $this->fileName = $this->setFileName();
    }

    public function setFileName(): string
    {
        $fileName = 'Siswa'  . '-template.xlsx';
        return $fileName;
    }
    public function title(): string
    {
        return 'Siswa' . ' template';
    }

    public function headings(): array
    {
        return [
            'kelas_id',
            'name',
            'nis',
            'jenkel',
            'tgl_lahir',
            'alamat',

        ];
    }
    public function collection()
    {
        return new Collection([
            [
                'kelas_id value',
                'name value',
                'nis value',
                'jenkel value: L or P',
                'tgl_lahir',
                'alamat',
            ],
        ]);
    }
}
