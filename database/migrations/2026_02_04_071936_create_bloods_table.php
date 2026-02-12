<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('bloods', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['donor', 'receiver'])->default('donor');

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('blood_group');
            $table->string('urgency')->default('standard');

            $table->string('country')->default('India');
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();

            $table->string('donor_name')->nullable();
            $table->string('preferred_area')->nullable();

            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();

            $table->boolean('is_active')->default(true);

            $table->integer('units')->nullable();
            $table->string('patient_name')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('hospital_location')->nullable();

            // Contact
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('notes')->nullable();

            // Common
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bloods');
    }
};
