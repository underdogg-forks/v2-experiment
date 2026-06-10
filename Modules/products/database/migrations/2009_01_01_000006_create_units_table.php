<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('units', static function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id', true);
            $table->unsignedBigInteger('company_id');
            $table->string('unit_name', 50)->nullable();
            $table->string('unit_name_plrl', 50)->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
