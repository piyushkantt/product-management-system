<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('import_jobs', function (Blueprint $table) {
    $table->id();
    $table->string('type'); // products_import
    $table->integer('total_rows')->default(0);
    $table->integer('processed_rows')->default(0);
    $table->string('status')->default('pending'); 
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_jobs');
    }
};
