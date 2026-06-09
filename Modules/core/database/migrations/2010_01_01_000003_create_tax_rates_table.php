<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('tax_rates', static function (Blueprint $table) {
            $table->unsignedBigInteger('tax_rate_id', true);
            $table->unsignedBigInteger('company_id');
            $table->text('tax_rate_name')->nullable();
            $table->decimal('tax_rate_percent', 5);

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_tax_rates');
    }
};
