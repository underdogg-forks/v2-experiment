<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('payment_methods', static function (Blueprint $table) {
            $table->unsignedBigInteger('payment_method_id', true);
            $table->text('payment_method_name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
