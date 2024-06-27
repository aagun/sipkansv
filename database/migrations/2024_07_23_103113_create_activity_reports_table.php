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
        Schema::create('activity_reports', function (Blueprint $table) {
            $table->id();
            $table->string('bap_number');
            $table->unsignedBigInteger('activity_id')->nullable();
            $table->unsignedBigInteger('observation_id')->nullable();
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->date('inspection_date');
            $table->string('company_name');
            $table->unsignedBigInteger('business_entity_type_id')->nullable();
            $table->text('address');
            $table->unsignedBigInteger('village_id')->nullable();
            $table->unsignedBigInteger('sub_district_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->string('nib');
            $table->date('effective_date');
            $table->string('project_code');
            $table->unsignedBigInteger('kbli_id')->nullable();
            $table->unsignedBigInteger('business_scale_id')->nullable();
            $table->string('persetujuan_kesesuaian_ruang');
            $table->string('persetujuan_lingkungan');
            $table->string('pbg_slf');
            $table->string('pernyataan_mandiri');
            $table->unsignedBigInteger('investment_type_id')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('sertifikat_standar');
            $table->decimal('kepatuhan_teknis', 3);
            $table->decimal('perizinan_berusaha_atas_kegiatan_usaha', 3);
            $table->decimal('persyaratan_umum_usaha', 3);
            $table->decimal('persyaratan_khusus_usaha', 3);
            $table->decimal('sarana', 3);
            $table->decimal('organisasi_dan_sdm', 3);
            $table->decimal('pelayanan', 3);
            $table->decimal('persyaratan_produk', 3);
            $table->decimal('sistem_manajemen_usaha', 3);
            $table->decimal('kepatuhan_administratif', 3);
            $table->decimal('pelaksanaan_kegiatan_usaha', 3);
            $table->decimal('riwayat_pengenaan_sanksi', 3);
            $table->enum('tingkat_kepatuhan_proyek', ['Baik Sekali', 'Baik', 'Kurang Baik']);
            $table->enum('kategory_kepatuhan', ['Patuh', 'Tidak Patuh']);
            $table->string('permasalahan_perusahaan');
            $table->string('hasil_pengawasan');
            $table->unsignedBigInteger('attachment_id')->nullable();
            $table->unsignedBigInteger('recommendation_id')->nullable();
            $table->enum('status', ['active', 'draft'])->nullable()->default('active');
            $table->timestamps();

            $table->foreign('activity_id')
                ->on('activities')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('observation_id')
                ->on('observations')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('supervisor_id')
                ->on('users')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('business_entity_type_id')
                ->on('business_entity_types')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('village_id')
                ->on('villages')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('sub_district_id')
                ->on('sub_districts')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('district_id')
                ->on('districts')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('province_id')
                ->on('provinces')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('manager_id')
                ->on('users')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('kbli_id')
                ->on('kblis')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('business_scale_id')
                ->on('business_scales')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('investment_type_id')
                ->on('investment_types')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('attachment_id')
                ->on('attachments')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('recommendation_id')
                ->on('recommendations')
                ->references('id')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_reports');
    }
};
