<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('quote_tax_rates', static function (Blueprint $table) {
            $table->unsignedBigInteger('quote_tax_rate_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('quote_id')->index('quote_tax_rates_quote_id_index');
            $table->unsignedBigInteger('tax_rate_id')->index('quote_tax_rates_tax_rate_id_index');
            $table->boolean('include_item_tax')->default(0);
            $table->decimal('quote_tax_rate_amount', 20)->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('quote_id')->references('quote_id')->on('quotes')->onDelete('cascade');
            $table->foreign('tax_rate_id')->references('tax_rate_id')->on('tax_rates')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_tax_rates');
    }
};
