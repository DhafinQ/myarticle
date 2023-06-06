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
        Schema::table('roles', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
