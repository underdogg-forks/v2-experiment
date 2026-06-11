<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('invoices_recurring', static function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_recurring_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('invoice_id')->index('recurring_invoices_invoice_id_index');
            $table->date('recur_start_date');
            $table->date('recur_end_date')->nullable();
            $table->string('recur_frequency')->comment('enum!');
            $table->date('recur_next_date')->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('invoice_id')->references('invoice_id')->on('invoices')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices_recurring');
    }
};
