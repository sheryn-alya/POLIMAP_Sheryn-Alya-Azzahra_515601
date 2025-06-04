<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('polylines', function (Blueprint $table) {
            $table->id();
            $table->geometry('geom')->nullable(); // butuh PostGIS aktif di PostgreSQL
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->string('photo')->nullable();
            $table->string('lainnya')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('polylines');
    }
};
