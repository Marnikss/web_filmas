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
        Schema::table('filmas', function (Blueprint $table) {
        $table->foreign('rezisors_id')->references('id')->on('rezisori');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('filmas', function (Blueprint $table) {
        $table->dropForeign('filmas_rezisors_id_foreign');
});
    }
};
