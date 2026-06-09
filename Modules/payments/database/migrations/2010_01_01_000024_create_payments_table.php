<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('payments', static function (Blueprint $table) {
            $table->unsignedBigInteger('payment_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('invoice_id')->index('invoice_id');
            $table->integer('payment_method_id')->default(0)->index('payment_method_id')->comment('enum!');
            $table->date('payment_date');
            $table->decimal('payment_amount', 20)->nullable()->index('payment_amount');
            $table->longText('payment_note');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('invoice_id')->references('invoice_id')->on('invoices')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_payments');
    }
};
