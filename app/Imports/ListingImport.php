<?php

namespace App\Imports;

use App\Models\BusinessHour;
use App\Models\Listing;
use App\Models\ListingCategoryDetails;
use App\Models\PlaceDetails;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;


class ListingImport implements ToModel, WithHeadingRow
{
    protected $purchase_package_id;

    public function __construct($purchase_package_id)
    {
        $this->purchase_package_id = $purchase_package_id;
    }
    public function model(array $row)
    {
        $namaPerusahaan = $row['nama_perusahaan'];
        $alamat = $row['alamat'];
        $jenisUsaha = $row['jenis_usaha'];
        $subCategory = $row['sub_kategori'];
        $catatan = $row['catatan'];
        
        // berikut di query dan di insert ke table business_hours
        $kode = $row['kode']; //field dari working_day
        $periodeAwal = $row['periode_awal']; //field dari start_time
        $periodeAkhir = $row['periode_akhir']; //field dari end_time
        

        $placeDetail = PlaceDetails::whereRaw("MATCH(place) AGAINST(? IN NATURAL LANGUAGE MODE)", [$alamat])->first();

        if (!$placeDetail) {
            return redirect()->route('listingCategoryCreate')->with('error', 'Detail tempat tidak ditemukan! Mohon tambahkan detail tempat terlebih dahulu.');
        }

        $category = ListingCategoryDetails::where('name', 'LIKE', '%' . $jenisUsaha . '%')->first();

        if (!$category) {
            return redirect()->route('listingCategoryCreate')->with('error', 'Kategori tidak ditemukan! Mohon tambahkan kategori terlebih dahulu.');
        }

        $listing = new Listing([
            'user_id' => 1,
            'category_id' => [$category->listing_category_id], // Save as array
            'place_id' => $placeDetail->id,
            'title' => $namaPerusahaan,
            'address' => $alamat,
            'phone' => (int)$row['telp'],
            'email' => $row['email'],
            'description' => $row['penjelasan_perusahaan'],
            'replies_text' => $subCategory,
            'body_text' => $catatan,
            'status' => 1, // status aktif
            'is_active' => 1, //  aktif
            'purchase_package_id' => $this->purchase_package_id,
        ]);

        $listing->save();

        // business_hours insert
        $businessHours = new BusinessHour([
            'listing_id' => $listing->id,
            'purchase_package_id' =>  $this->purchase_package_id,
            'working_day' => $kode,
            'start_time' => $periodeAwal,
            'end_time' => $periodeAkhir,
        ]);

        $businessHours->save();

        return $listing;
    }
}
