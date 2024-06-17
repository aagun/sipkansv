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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nip')->nullable()->change();
            $table->dropUnique(['email']);
            $table->string('email')->nullable()->change();
            $table->string('phone')->nullable();
            $table->string('username')->unique();
            $table->string('rank_id')->nullable();
            $table->string('comity_id')->nullable();
            $table->string('education_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('institution_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('nip')->change();
            $table->string('name')->unique()->change();
        });
    }
};
