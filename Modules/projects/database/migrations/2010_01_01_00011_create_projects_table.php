<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('projects', static function (Blueprint $table) {
            $table->unsignedBigInteger('project_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('client_id');
            $table->text('project_name')->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
