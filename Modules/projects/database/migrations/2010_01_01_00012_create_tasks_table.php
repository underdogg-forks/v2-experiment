<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('tasks', static function (Blueprint $table) {
            $table->unsignedBigInteger('task_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('project_id');
            $table->string('task_name')->nullable();
            $table->longText('task_description');
            $table->decimal('task_price', 20)->nullable();
            $table->date('task_finish_date');
            $table->boolean('task_status');
            $table->unsignedBigInteger('tax_rate_id');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
            $table->foreign('tax_rate_id')->references('tax_rate_id')->on('tax_rates')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
