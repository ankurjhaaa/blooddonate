<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bloods', function (Blueprint $table) {
            $table->integer('age')->nullable()->after('blood_group');
            $table->integer('weight')->nullable()->after('age');
        });
    }

    public function down(): void
    {
        Schema::table('bloods', function (Blueprint $table) {
            $table->dropColumn(['age', 'weight']);
        });
    }
};
