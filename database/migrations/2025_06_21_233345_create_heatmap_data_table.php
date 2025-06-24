<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeatmapDataTable extends Migration
{
    public function up(): void
    {
        Schema::create('heatmap_data', function (Blueprint $table) {
            $table->id();
            $table->string('kategori')->nullable(); // contoh: "Kejahatan", "Kemacetan"
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->float('intensitas')->default(0.5); // nilai antara 0 - 1
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('heatmap_data');
    }
}
