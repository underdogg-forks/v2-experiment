<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('custom_fields', static function (Blueprint $table) {
            $table->unsignedBigInteger('custom_field_id', true);
            $table->unsignedBigInteger('company_id');
            $table->string('custom_field_table', 50)->nullable()->index('custom_field_table');
            $table->string('custom_field_label', 50)->nullable();
            $table->string('custom_field_type')->default('TEXT');
            $table->integer('custom_field_location')->nullable()->default(0);
            $table->integer('custom_field_order')->nullable()->default(999);

            $table->unique(['custom_field_table', 'custom_field_label'], 'custom_field_table_2');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_custom_fields');
    }
};
