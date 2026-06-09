<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('invoice_item_amounts', static function (Blueprint $table) {
            $table->unsignedBigInteger('item_amount_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('item_id')->index('item_id');
            $table->decimal('item_subtotal', 20)->nullable();
            $table->decimal('item_tax_total', 20)->nullable();
            $table->decimal('item_discount', 20)->nullable();
            $table->decimal('item_total', 20)->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('item_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_invoice_item_amounts');
    }
};
