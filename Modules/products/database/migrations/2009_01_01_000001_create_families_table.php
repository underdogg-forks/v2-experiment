<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('families', static function (Blueprint $table) {
            $table->unsignedBigInteger('family_id', true);
            $table->unsignedBigInteger('company_id');
            $table->string('family_name')->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_families');
    }
};
