<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportJob;

use Illuminate\Http\Request;

class ImportProgressController extends Controller
{
    //
    public function show(ImportJob $importJob)
{
    return view('admin.imports.progress', compact('importJob'));
}
}
