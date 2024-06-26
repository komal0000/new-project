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
        Schema::table('generallayouts', function (Blueprint $table) {
            $table->dropColumn('copy_right_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('generallayouts', function (Blueprint $table) {
            $table->date('copy_right_date')->nullable();

        });
    }
};
