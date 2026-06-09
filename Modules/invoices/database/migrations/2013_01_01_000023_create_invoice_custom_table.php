<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('invoice_custom', static function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_custom_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('invoice_custom_fieldid');
            $table->text('invoice_custom_fieldvalue')->nullable();

            $table->unique(['invoice_id', 'invoice_custom_fieldid'], 'invoice_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('invoice_id')->references('invoice_id')->on('invoices')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_invoice_custom');
    }
};
