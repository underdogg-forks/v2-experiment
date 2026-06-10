<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('settings', static function (Blueprint $table) {
            $table->unsignedBigInteger('setting_id', true);
            $table->unsignedBigInteger('company_id');
            $table->string('setting_key', 50)->index('settings_key_index');
            $table->longText('setting_value');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
