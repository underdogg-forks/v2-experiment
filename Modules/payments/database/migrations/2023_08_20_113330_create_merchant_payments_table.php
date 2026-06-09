<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('merchant_payments', static function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('payment_id');
            $table->string('driver');
            $table->string('merchant_key');
            $table->string('merchant_value');

            $table->index('driver');
            $table->index('payment_id');
            $table->index('merchant_key');

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('payment_id')->references('payment_id')->on('payments');
        });
    }

    public function down()
    {
        Schema::dropIfExists('merchant_payments');
    }
};
