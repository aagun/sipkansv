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
            $table->dropColumn('email_verified_at');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('nip');
            $table->enum('gender', ['l', 'p']);
            $table->enum('status', ['aktif', 'non-aktif'])->default('aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('email_verified_at')->nullable();;
            $table->dropColumn('role_id');
            $table->dropColumn('nip');
            $table->dropColumn('gender');
            $table->dropColumn('status');
        });
    }
};
