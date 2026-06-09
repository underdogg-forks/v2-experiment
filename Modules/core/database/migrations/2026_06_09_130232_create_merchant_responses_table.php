<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('merchant_responses', static function (Blueprint $table) {
            $table->unsignedBigInteger('merchant_response_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('invoice_id')->index('invoice_id');
            $table->boolean('merchant_response_successful')->nullable()->default(true);
            $table->date('merchant_response_date')->index('merchant_response_date');
            $table->string('merchant_response_driver', 35);
            $table->string('merchant_response');
            $table->string('merchant_response_reference');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('invoice_id')->references('invoice_id')->on('invoices')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_merchant_responses');
    }
};
