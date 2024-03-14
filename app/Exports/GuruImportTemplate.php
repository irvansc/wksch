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

class GuruImportTemplate implements FromCollection, Responsable, ShouldAutoSize, WithHeadings, WithStrictNullComparison, WithTitle
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
        $fileName = 'Guru'  . '-template.xlsx';
        return $fileName;
    }
    public function title(): string
    {
        return 'Guru' . ' template';
    }

    public function headings(): array
    {
        return [
            'name',
            'nip',
            'jenkel',
            'tgl_lahir',
            'gtk',
            'alamat',

        ];
    }
    public function collection()
    {
        return new Collection([
            [
            'name value',
            'nip value',
            'jenkel value: L or P',
            'tgl_lahir',
            'gtk',
            'alamat',

        ],
        ]);
    }
}
