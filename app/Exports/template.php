<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class template implements FromView
{
    protected $products;
    public function __construct($productLists)
    {
        $this -> products = $productLists;
    }
    public function view(): View
    {
        if(!empty($this->products)){
            // dd($this->products);
            return view('main.products.exportTemplate', [
                'products' => $this -> products
            ]);
        }else{
            return view('Không có dữ liệu');
        }

    }

}
