<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel,SkipsEmptyRows, WithBatchInserts, WithChunkReading, WithStartRow, WithValidation
{
    use Importable;

    public function customValidationAttributes()
    {
        return [
            '0' => 'kelas_id',
            '1' => 'name',
            '2' => 'nis',
            '3' => 'jenkel',
            '4' => 'tgl_lahir',
            '5' => 'alamat',
        ];
    }

    public function rules(): array
    {
        return [
            '0' => [
                'required',
                'numeric',
            ],
            '1' => [
                'required',
            ],
            '2' => [
                'required',
            ],
            '3' => [
                'required',
            ],
            '4' => [
                'required',
            ],
            '5' => [
                'required',
            ],

        ];
    }
    public function model(array $row)
    {
        $date = intval($row[4]);
        Siswa::create([
            'kelas_id' => $row[0],
            'name' => $row[1],
            'nis' => $row[2],
            'jenkel' => $row[3],
            'tgl_lahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date),
            'alamat' => $row[5],
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
