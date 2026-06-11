<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('imports', static function (Blueprint $table) {
            $table->unsignedBigInteger('import_id', true);
            $table->dateTime('import_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imports');
    }
};
