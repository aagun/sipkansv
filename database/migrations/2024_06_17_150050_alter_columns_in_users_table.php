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
            //unsignedBigInteger
            $table->unsignedBigInteger('rank_id')->nullable()->change();
            $table->unsignedBigInteger('comity_id')->nullable()->change();
            $table->unsignedBigInteger('education_id')->nullable()->change();
            $table->unsignedBigInteger('department_id')->nullable()->change();
            $table->unsignedBigInteger('institution_id')->nullable()->change();

            $table->foreign('rank_id')
                ->on('ranks')
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
            $table->dropForeign(['rank_id']);

            $table->dropColumn('rank_id');
            $table->dropColumn('comity_id');
            $table->dropColumn('education_id');
            $table->dropColumn('department_id');
            $table->dropColumn('institution_id');

            $table->string('redefined_rank_id')->nullable();
            $table->string('redefined_comity_id')->nullable();
            $table->string('redefined_education_id')->nullable();
            $table->string('redefined_department_id')->nullable();
            $table->string('redefined_institution_id')->nullable();
            $table->renameColumn('redefined_rank_id', 'rank_id')->nullable();
            $table->renameColumn('redefined_comity_id', 'comity_id')->nullable();
            $table->renameColumn('redefined_education_id', 'education_id')->nullable();
            $table->renameColumn('redefined_department_id', 'department_id')->nullable();
            $table->renameColumn('redefined_institution_id', 'institution_id')->nullable();
        });
    }
};
