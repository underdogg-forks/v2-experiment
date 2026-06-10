<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('invoice_tax_rates', static function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_tax_rate_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('tax_rate_id');
            $table->boolean('include_item_tax')->default(0);
            $table->decimal('invoice_tax_rate_amount', 10)->default(0);

            $table->index(['invoice_id', 'tax_rate_id'], 'invoice_tax_rates_invoice_taxrate_index');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('invoice_id')->references('invoice_id')->on('invoices')->onDelete('cascade');
            $table->foreign('tax_rate_id')->references('tax_rate_id')->on('tax_rates')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_tax_rates');
    }
};
