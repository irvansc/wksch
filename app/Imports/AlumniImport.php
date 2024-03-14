<?php

namespace App\Imports;

use App\Models\Alumni;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AlumniImport implements ToModel, SkipsEmptyRows, WithBatchInserts, WithChunkReading, WithStartRow, WithValidation
{
    use Importable;

    public function customValidationAttributes()
    {
        return [
            '0' => 'name',
            '1' => 'nis',
            '2' => 'jenkel',
            '3' => 'tgl_lahir',
            '4' => 'thn_masuk',
            '5' => 'thn_lulus',
            '6' => 'alamat',
            '7' => 'email',
            '8' => 'telp',
        ];
    }

    public function rules(): array
    {
        return [
            '0' => [
                'required',
                'string',
            ],
            '1' => [
                'required',
                'numeric',
            ],
            '2' => [
                'required',
            ],
            '3' => [
                'required',
            ],
            '4' => [
                'required',
                'numeric',

            ],
            '5' => [
                'required',
                'numeric',

            ],
            '6' => [
                'required',

            ],
            '7' => [
                'required',
                'string',
                'email'
            ],
            '8' => [
                'required',
                'numeric',

            ],
        ];
    }
    public function model(array $row)
    {
        $date = intval($row[3]);
        Alumni::create([
            'name' => $row[0],
            'nis' => $row[1],
            'jenkel' => $row[2],
            'tgl_lahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date),
            'thn_masuk' => $row[4],
            'thn_lulus' => $row[5],
            'alamat' => $row[6],
            'email' => $row[7],
            'telp' => $row[8],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
