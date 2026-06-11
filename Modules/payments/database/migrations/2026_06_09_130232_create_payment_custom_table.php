<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('payment_custom', static function (Blueprint $table) {
            $table->unsignedBigInteger('payment_custom_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('payment_custom_fieldid');
            $table->text('payment_custom_fieldvalue')->nullable();

            $table->unique(['payment_id', 'payment_custom_fieldid'], 'payment_custom_id_fieldid_unique');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('payment_id')->references('payment_id')->on('payments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_custom');
    }
};
