<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('item_lookups', static function (Blueprint $table) {
            $table->unsignedBigInteger('item_lookup_id', true);
            $table->unsignedBigInteger('company_id');
            $table->string('item_name', 100)->default('');
            $table->longText('item_description');
            $table->decimal('item_price', 10);

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_item_lookups');
    }
};
