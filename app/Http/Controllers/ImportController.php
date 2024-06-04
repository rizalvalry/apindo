<?php

namespace App\Http\Controllers;

use App\Imports\ListingImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;


class ImportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // Sesuaikan dengan ekstensi yang diizinkan dan ukuran maksimal file
        ]);

        $file = $request->file('file');

        try {
            Excel::import(new ListingImport(), $file);

            return redirect()->route('admin.listingviews')->with('success', 'Data has been imported successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
