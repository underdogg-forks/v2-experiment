<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('invoice_sumex', static function (Blueprint $table) {
            $table->unsignedBigInteger('sumex_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('sumex_invoice');
            $table->integer('sumex_reason');
            $table->string('sumex_diagnosis', 500);
            $table->string('sumex_observations', 500);
            $table->date('sumex_treatmentstart');
            $table->date('sumex_treatmentend');
            $table->date('sumex_casedate');
            $table->string('sumex_casenumber', 35)->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('sumex_invoice')->references('invoice_id')->on('invoices')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_sumex');
    }
};
