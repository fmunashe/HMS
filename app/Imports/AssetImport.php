<?php

namespace App\Imports;

use App\Asset;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class AssetImport implements ToModel,WithBatchInserts,WithChunkReading,WithHeadingRow,WithValidation,SkipsOnFailure,WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable,SkipsFailures;
    public function model(array $row)
    {
        return new Asset([
            'asset_number'=>$row["asset_number"],
            'asset_name'=>$row["asset_name"],
            'serial_number'=>$row["serial_number"],
            'asset_value'=>$row["asset_value"],
            'asset_description'=>$row["asset_description"],
            'status'=>$row["status"],
        ]);
    }

    public function batchSize(): int
    {
        return 100;
    }
    public function chunkSize(): int
    {
        return 100;
    }
    public function rules():array{
        return [
            'asset_number'=>'required|unique:assets',
            '*.asset_number'=>'required|unique:assets'
        ];
    }
    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'ISO-8859-1'
        ];
    }

}
