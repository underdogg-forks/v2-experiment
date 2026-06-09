<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('invoice_groups', static function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_group_id', true);
            $table->unsignedBigInteger('company_id');
            $table->text('invoice_group_name')->nullable();
            $table->string('invoice_group_identifier_format');
            $table->integer('invoice_group_next_id')->index('invoice_group_next_id');
            $table->integer('invoice_group_left_pad')->default(0)->index('invoice_group_left_pad');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_invoice_groups');
    }
};
