<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('client_custom', static function (Blueprint $table) {
            $table->unsignedBigInteger('client_custom_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('client_custom_fieldid');
            $table->text('client_custom_fieldvalue')->nullable();

            $table->unique(['client_id', 'client_custom_fieldid'], 'client_custom_client_fieldid_unique');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_custom');
    }
};
