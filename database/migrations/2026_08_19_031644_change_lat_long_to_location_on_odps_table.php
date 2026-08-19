<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('odps', function (Blueprint $table) {
        $table->dropColumn(['latitude', 'longitude']);
        $table->json('location')->nullable()->after('lokasi');
    });
}

public function down(): void
{
    Schema::table('odps', function (Blueprint $table) {
        $table->dropColumn('location');
        $table->decimal('latitude', 10, 7)->nullable();
        $table->decimal('longitude', 10, 7)->nullable();
    });
}
};
