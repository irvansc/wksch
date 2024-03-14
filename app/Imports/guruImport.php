<?php

namespace App\Imports;

use App\Models\Guru;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class guruImport implements ToModel, SkipsEmptyRows, WithBatchInserts, WithChunkReading, WithStartRow, WithValidation
{
    use Importable;

    public function customValidationAttributes()
    {
        return [
            '0' => 'name',
            '1' => 'nip',
            '2' => 'jenkel',
            '3' => 'tgl_lahir',
            '4' => 'gtk',
            '5' => 'alamat',
        ];
    }

    public function rules(): array
    {
        return [
            '0' => [
                'required',
                'max:100',
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
            ],
            '5' => [
                'required',
            ],

        ];
    }
    public function model(array $row)
    {
        $date = intval($row[3]);
        Guru::create([
            'name' => $row[0],
            'nip' => $row[1],
            'jenkel' => $row[2],
            'tgl_lahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date),
            'gtk' => $row[4],
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
