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
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');

            $table->unsignedInteger('redefined_role_id')->nullable();
            $table->renameColumn('redefined_role_id', 'role_id');

            $table->foreign('role_id')
                ->on('roles')
                ->references('id')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');

            $table->unsignedInteger('redefined_role_id')->nullable();
            $table->renameColumn('redefined_role_id', 'role_id');

            $table->foreign('role_id')
                ->on('roles')
                ->references('id');
        });
    }
};
