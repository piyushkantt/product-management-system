<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportJob extends Model
{
    protected $fillable = [
        'type',
        'total_rows',
        'processed_rows',
        'status',
    ];
}
