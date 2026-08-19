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
    Schema::create('odps', function (Blueprint $table) {
        $table->id();
        $table->string('nama_odp');           // misal: ODP-JPR-01
        $table->string('wilayah');             // misal: Jepara Kota
        $table->text('lokasi')->nullable();    // alamat/deskripsi lokasi
        $table->decimal('latitude', 10, 7)->nullable();
        $table->decimal('longitude', 10, 7)->nullable();
        $table->unsignedInteger('kapasitas')->default(8); // jumlah port
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odps');
    }
};
