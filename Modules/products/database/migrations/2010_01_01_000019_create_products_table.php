<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('products', static function (Blueprint $table) {
            $table->unsignedBigInteger('product_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('family_id')->nullable();
            $table->string('product_sku')->nullable();
            $table->string('product_name')->nullable();
            $table->longText('product_description');
            $table->decimal('product_price', 20)->nullable();
            $table->decimal('purchase_price', 20)->nullable();
            $table->string('provider_name')->nullable();
            $table->unsignedBigInteger('tax_rate_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->integer('product_tariff')->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('family_id')->references('family_id')->on('families')->onDelete('cascade');
            $table->foreign('tax_rate_id')->references('tax_rate_id')->on('tax_rates')->onDelete('cascade');
            $table->foreign('unit_id')->references('unit_id')->on('units')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
