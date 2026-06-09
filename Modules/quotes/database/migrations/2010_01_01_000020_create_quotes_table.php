<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('quotes', static function (Blueprint $table) {
            $table->unsignedBigInteger('quote_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('invoice_id')->default(0)->index('invoice_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('invoice_group_id');
            $table->tinyInteger('quote_status_id')->default(1)->index('quote_status_id')->comment('enum!');
            $table->date('quote_date_expires');
            $table->string('quote_number', 100)->nullable();
            $table->decimal('quote_discount_amount', 20)->nullable();
            $table->decimal('quote_discount_percent', 20)->nullable();
            $table->char('quote_url_key', 32);
            $table->string('quote_password', 90)->nullable();
            $table->longText('notes')->nullable();
            $table->date('quote_date_created');
            $table->dateTime('quote_date_modified');

            $table->index(['user_id', 'client_id', 'invoice_group_id', 'quote_date_created', 'quote_date_expires', 'quote_number'], 'user_id');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
            $table->foreign('invoice_group_id')->references('invoice_group_id')->on('invoice_groups')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_quotes');
    }
};
