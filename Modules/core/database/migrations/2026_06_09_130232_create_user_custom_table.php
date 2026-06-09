<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('user_custom', static function (Blueprint $table) {
            $table->unsignedBigInteger('user_custom_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_custom_fieldid');
            $table->text('user_custom_fieldvalue')->nullable();

            $table->unique(['user_id', 'user_custom_fieldid'], 'user_id');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_user_custom');
    }
};
