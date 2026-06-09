<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('quote_items', static function (Blueprint $table) {
            $table->unsignedBigInteger('item_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('quote_id');
            $table->unsignedBigInteger('tax_rate_id')->index('item_tax_rate_id');
            $table->unsignedBigInteger('item_product_id')->nullable();
            $table->date('item_date_added');
            $table->string('item_name')->nullable();
            $table->text('item_description')->nullable();
            $table->decimal('item_quantity', 20, 8)->nullable();
            $table->decimal('item_price', 20)->nullable();
            $table->decimal('item_discount_amount', 20)->nullable();
            $table->integer('item_order')->default(0);
            $table->string('item_product_unit', 50)->nullable();
            $table->unsignedBigInteger('item_product_unit_id')->nullable();

            $table->index(['quote_id', 'item_date_added', 'item_order'], 'quote_id');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('quote_id')->references('quote_id')->on('quotes')->onDelete('cascade');
            $table->foreign('tax_rate_id')->references('tax_rate_id')->on('tax_rates')->onDelete('cascade');
            $table->foreign('item_product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('item_product_unit_id')->references('unit_id')->on('units')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_quote_items');
    }
};
