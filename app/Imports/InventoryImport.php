<?php

namespace App\Imports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;


class InventoryImport implements ToModel, WithStartRow, SkipsEmptyRows, SkipsOnError{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
 public int $duplicates = 0;
 public int $imported = 0;
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        $this->imported++;
        return new Inventory([
            'item_code' => $row[0],
            'item_name' => $row[1],
            'quantity' => (int) $row[2],
            'disposable' => (bool) $row[3],
        ]);
    }

   

    public function onError(Throwable $e)
    {
        if ($e->getCode() === '23000') {
            $this->duplicates++;
            $this->imported--;
            return;
        }

        throw $e;
    }
}

