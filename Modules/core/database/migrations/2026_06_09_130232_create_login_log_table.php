<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('login_log', static function (Blueprint $table) {
            $table->string('login_name', 100)->primary();
            $table->integer('log_count')->nullable()->default(0);
            $table->dateTime('log_create_timestamp')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_login_log');
    }
};
