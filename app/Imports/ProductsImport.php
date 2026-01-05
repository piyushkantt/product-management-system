<?php

namespace App\Imports;

use App\Models\ImportJob;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;


class ProductsImport implements
    ToModel,
    WithHeadingRow,
    WithChunkReading,
    WithValidation,
    ShouldQueue
{
        protected int $importJobId;
public function __construct(int $importJobId)
    {
        $this->importJobId = $importJobId;
    }
  public function model(array $row)
{
    ImportJob::where('id', $this->importJobId)
        ->increment('processed_rows');

    ImportJob::where('id', $this->importJobId)
        ->update(['status' => 'processing']);

    return new Product([
        'name' => $row['name'],
        'description' => $row['description'] ?? null,
        'price' => $row['price'],
        'category' => $row['category'],
        'stock' => $row['stock'],
        'image' => $row['image'] ?? 'default.png',
    ]);
}


    public function rules(): array
    {
        return [
            '*.name'     => ['required', 'string', 'max:255'],
            '*.price'    => ['required', 'numeric', 'min:0'],
            '*.category' => ['required', 'string', 'max:100'],
            '*.stock'    => ['required', 'integer', 'min:0'],
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
    public function __destruct()
{
    ImportJob::where('id', $this->importJobId)
        ->update(['status' => 'completed']);
}

}
