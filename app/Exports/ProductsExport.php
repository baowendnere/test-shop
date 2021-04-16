<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

//class ProductsExport implements FromCollection
class ProductsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Product::all();
    // }

    public function view(): View
    {
        return view('partials._list-products', [
            'products' => Product::all()
        ]);
    }
}
