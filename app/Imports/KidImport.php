<?php

namespace App\Imports;

use App\Models\Kid;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KidImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Kid::updateOrCreate(
            [
                'name' => $row[1],
                'cpf' => $row[2]
            ],
            [
                'process' => $row[0],
                'state' => $row[3]
            ]
        );
    }
}
