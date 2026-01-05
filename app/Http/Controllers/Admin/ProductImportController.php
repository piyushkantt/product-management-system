<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use App\Models\ImportJob;
use Maatwebsite\Excel\Facades\Excel;
class ProductImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.products.import');
    }

   public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:csv,xlsx',
    ]);

    // Count rows (excluding header)
    $rows = array_slice(
        file($request->file->getRealPath()),
        1
    );

    $importJob = ImportJob::create([
        'type' => 'products_import',
        'total_rows' => count($rows),
        'status' => 'pending',
    ]);

    Excel::queueImport(
        new ProductsImport($importJob->id),
        $request->file('file')
    );

    return redirect()
        ->route('admin.import.progress', $importJob)
        ->with('success', 'Import started');
}
}



