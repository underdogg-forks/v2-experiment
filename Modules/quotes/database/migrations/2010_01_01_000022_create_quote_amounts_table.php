<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('quote_amounts', static function (Blueprint $table) {
            $table->unsignedBigInteger('quote_amount_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('quote_id')->index('quote_id');
            $table->decimal('quote_item_subtotal', 20)->nullable();
            $table->decimal('quote_item_tax_total', 20)->nullable();
            $table->decimal('quote_tax_total', 20)->nullable();
            $table->decimal('quote_total', 20)->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('quote_id')->references('quote_id')->on('quotes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_quote_amounts');
    }
};
