<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('clients', static function (Blueprint $table) {
            $table->unsignedBigInteger('client_id', true);
            $table->unsignedBigInteger('company_id');
            $table->string('client_name')->nullable();
            $table->string('client_company', 150)->nullable();
            $table->string('client_address_1')->nullable();
            $table->string('client_address_2')->nullable();
            $table->string('client_city')->nullable();
            $table->string('client_state')->nullable();
            $table->string('client_zip')->nullable();
            $table->string('client_country')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('client_fax')->nullable();
            $table->string('client_mobile')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_web')->nullable();
            $table->string('client_vat_id')->nullable();
            $table->string('client_tax_code')->nullable();
            $table->string('client_language')->nullable()->default('system');
            $table->boolean('client_active')->default(1)->index('client_active');
            $table->string('client_surname')->nullable();
            $table->string('client_invoicing_contact', 50)->nullable();
            $table->string('client_title', 50)->nullable();
            $table->boolean('client_einvoicing_active')->default(false);
            $table->string('client_einvoicing_version', 25)->nullable();
            $table->string('client_avs', 16)->nullable();
            $table->string('client_insurednumber', 30)->nullable();
            $table->string('client_veka', 30)->nullable();
            $table->date('client_birthdate')->nullable();
            $table->integer('client_gender')->nullable()->default(0)->comment('enum!');
            $table->dateTime('client_date_created');
            $table->dateTime('client_date_modified');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_clients');
    }
};
