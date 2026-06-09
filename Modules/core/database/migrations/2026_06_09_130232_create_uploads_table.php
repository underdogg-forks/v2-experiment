<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('uploads', static function (Blueprint $table) {
            $table->unsignedBigInteger('upload_id', true);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('client_id');
            $table->char('url_key', 32);
            $table->longText('file_name_original');
            $table->longText('file_name_new');
            $table->date('uploaded_date');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_uploads');
    }
};
