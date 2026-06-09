<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('email_templates', static function (Blueprint $table) {
            $table->unsignedBigInteger('email_template_id', true);
            $table->unsignedBigInteger('company_id');
            $table->string('email_template_title')->nullable();
            $table->string('email_template_type')->nullable();
            $table->longText('email_template_body');
            $table->string('email_template_subject')->nullable();
            $table->string('email_template_from_name')->nullable();
            $table->string('email_template_from_email')->nullable();
            $table->string('email_template_cc')->nullable();
            $table->string('email_template_bcc')->nullable();
            $table->string('email_template_pdf_template')->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_templates');
    }
};
