<?php

namespace App\Exports;

use App\Models\PurchasePackage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PackageExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $selected_package_id = '';
    public function __construct($selected_package_id)
    {
        $this->selected_package_id = $selected_package_id;
    }

    public function collection()
    {
        $package_id_array = explode(",", $this->selected_package_id);
        $all_selected_package_list = PurchasePackage::whereIn('id', $package_id_array)->get(['package_id', 'price', 'purchase_date', 'expire_date']);
        return $all_selected_package_list;
    }

     public function headings(): array
     {
         return ["Package", "Price", 'Purchased Date', 'Expired Date'];
     }
}
