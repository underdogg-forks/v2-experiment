<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('quote_custom', static function (Blueprint $table) {
            $table->unsignedBigInteger('quote_custom_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('quote_id');
            $table->unsignedBigInteger('quote_custom_fieldid');
            $table->text('quote_custom_fieldvalue')->nullable();

            $table->unique(['quote_id', 'quote_custom_fieldid'], 'quote_custom_id_fieldid_unique');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('quote_id')->references('quote_id')->on('quotes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_custom');
    }
};
