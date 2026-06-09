<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('invoice_items', static function (Blueprint $table) {
            $table->unsignedBigInteger('item_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('item_tax_rate_id')->default(0);
            $table->unsignedBigInteger('item_product_id')->nullable();
            $table->unsignedBigInteger('item_task_id')->nullable();
            $table->date('item_date_added');
            $table->string('item_name')->nullable();
            $table->longText('item_description')->nullable();
            $table->decimal('item_quantity', 20, 8)->nullable();
            $table->decimal('item_price', 20)->nullable();
            $table->decimal('item_discount_amount', 20)->nullable();
            $table->integer('item_order')->default(0);
            $table->boolean('item_is_recurring')->nullable();
            $table->string('item_product_unit', 50)->nullable();
            $table->unsignedBigInteger('item_product_unit_id')->nullable();
            $table->date('item_date')->nullable();

            $table->index(['invoice_id', 'item_tax_rate_id', 'item_date_added', 'item_order'], 'invoice_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('invoice_id')->references('invoice_id')->on('invoices')->onDelete('cascade');
            $table->foreign('item_tax_rate_id')->references('tax_rate_id')->on('tax_rates')->onDelete('cascade');
            $table->foreign('item_task_id')->references('task_id')->on('tasks')->onDelete('cascade');
            $table->foreign('item_product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('item_product_unit_id')->references('unit_id')->on('units')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_invoice_items');
    }
};
