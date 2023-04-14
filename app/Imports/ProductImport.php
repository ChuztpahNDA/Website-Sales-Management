<?php

namespace App\Imports;

use App\Models\products as ModelsProducts;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
     * @param Collection $collection
     */
    public $timestamps = true;

    public function collection(Collection $ListData)
    {
        // dd($rows);
        foreach ($ListData as $row) {
            $data = [
                'URLImages' => $row['urlimages'],
                'nameProduct' => $row['nameproduct'],
                'quatity' => $row['quatity'],
                'priceProduct' => $row['priceproduct'],
                'purchaseProduct' => $row['purchaseproduct'],
                'description' => $row['description'],
            ];
            ModelsProducts::create($data);
        }
    }

    public function rules(): array
    {
        return [
            'nameproduct' => 'required|unique:products',
            'quatity' => 'numeric',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nameproduct.required' => 'Tên sản phẩm không được để trống',
            'nameproduct.unique' => 'Tên sản phẩm đã tồn tại',
            'quatity.numeric' => 'Cột "Số lượng" không đúng định dạng là số'

        ];
    }
}



