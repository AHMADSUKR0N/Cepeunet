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
    Schema::table('clients', function (Blueprint $table) {
        $table->foreignId('odp_id')->nullable()->after('id')->constrained('odps')->nullOnDelete();
        $table->string('wilayah')->nullable()->after('alamat');
        $table->decimal('latitude', 10, 7)->nullable()->after('wilayah');
        $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('clients', function (Blueprint $table) {
        $table->dropForeign(['odp_id']);
        $table->dropColumn(['odp_id', 'wilayah', 'latitude', 'longitude']);
    });
}
};
