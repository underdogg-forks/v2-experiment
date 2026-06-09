<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('invoices', static function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('invoice_group_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('invoice_status_id')->default(1)->index('invoice_status_id')->comment('enum!');
            $table->boolean('is_read_only')->nullable();
            $table->string('invoice_password', 90)->nullable();
            $table->date('invoice_date_created');
            $table->time('invoice_time_created')->default('00:00:00');
            $table->dateTime('invoice_date_modified');
            $table->date('invoice_date_due');
            $table->string('invoice_number', 100)->nullable();
            $table->decimal('invoice_discount_amount', 20)->nullable();
            $table->decimal('invoice_discount_percent', 20)->nullable();
            $table->longText('invoice_terms');
            $table->char('invoice_url_key', 32)->unique('invoice_url_key');
            $table->integer('payment_method')->default(0)->comment('enum!');
            $table->unsignedBigInteger('creditinvoice_parent_id')->nullable();

            $table->index(['user_id', 'client_id', 'invoice_group_id', 'invoice_date_created', 'invoice_date_due', 'invoice_number'], 'user_id');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
            $table->foreign('invoice_group_id')->references('invoice_group_id')->on('invoice_groups')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('creditinvoice_parent_id')->references('invoice_id')->on('invoices')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_invoices');
    }
};
