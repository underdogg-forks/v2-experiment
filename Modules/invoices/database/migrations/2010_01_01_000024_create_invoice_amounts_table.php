<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('invoice_amounts', static function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_amount_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('invoice_id')->index('invoice_amounts_invoice_id_index');
            $table->string('invoice_sign')->default('1')->comment('enum!');
            $table->decimal('invoice_item_subtotal', 20)->nullable();
            $table->decimal('invoice_item_tax_total', 20)->nullable();
            $table->decimal('invoice_tax_total', 20)->nullable();
            $table->decimal('invoice_total', 20)->nullable();
            $table->decimal('invoice_paid', 20)->nullable();
            $table->decimal('invoice_balance', 20)->nullable();

            $table->index(['invoice_paid', 'invoice_balance'], 'invoice_amounts_paid_balance_index');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('invoice_id')->references('invoice_id')->on('invoices')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_amounts');
    }
};
