<?php

namespace App\Exports;

use App\Models\PurchasePackage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PackageExportCsv implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $package_id = '';
    public function __construct($package_id)
    {
        $this->package_id = $package_id;
    }

    public function collection()
    {
        $package_id_array = explode(",", $this->package_id);
        $all_selected_package_list = PurchasePackage::with(['get_user', 'getPlanInfo.details'])->whereIn('id', $package_id_array)->get(['package_id', 'price', 'purchase_date', 'expire_date']);
        return $all_selected_package_list;
    }
    public function headings(): array
    {
        return ["Package", "Price", 'Purchased Date', 'Expired Date'];
    }
}
