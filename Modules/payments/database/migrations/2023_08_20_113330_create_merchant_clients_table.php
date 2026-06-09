<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('merchant_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('client_id');
            $table->string('driver');
            $table->string('merchant_key');
            $table->string('merchant_value');

            $table->index('driver');
            $table->index('client_id');
            $table->index('merchant_key');

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('client_id')->references('client_id')->on('clients');
        });
    }

    public function down()
    {
        Schema::dropIfExists('merchant_clients');
    }
};
