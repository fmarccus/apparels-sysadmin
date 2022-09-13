<?php

namespace App\Imports;

use App\Models\Apparel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ApparelImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Apparel([
            'name' => $row['name'],
            'sku' => $row['sku'],
            'orig_quantity' => $row['orig_quantity'],
            'quantity' => $row['quantity'],
            'purchasePrice' => $row['purchaseprice'],
            'retailPrice' => $row['retailprice'],
            'style' => $row['style'],
            'type' => $row['type'],
            'color' => $row['color'],
            'image' => $row['image']
        ]);
    }
}
