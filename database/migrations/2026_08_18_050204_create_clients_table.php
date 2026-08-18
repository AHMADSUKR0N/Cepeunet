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
    Schema::create('clients', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('no_hp')->nullable();
        $table->string('email')->nullable();
        $table->text('alamat')->nullable();
        $table->string('paket');
        $table->decimal('harga', 10, 2)->default(0);
        $table->date('tanggal_pasang')->nullable();
        $table->enum('status', ['aktif', 'nonaktif', 'suspend'])->default('aktif');
        $table->string('no_sn_modem')->nullable();
        $table->text('catatan')->nullable();
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
