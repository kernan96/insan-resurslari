<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('academic_degrees', function (Blueprint $table) {
            $table->id();
            $table->date('given_date')->nullable();        // verilmə tarixi
            $table->string('given_org')->nullable();       // verən təşkilat
            $table->string('doc_number')->nullable();      // sənəd nömrəsi
            $table->date('doc_date')->nullable();          // sənəd tarixi

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('academic_type_id')
                ->nullable()
                ->constrained('academic_types')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_degrees');
    }
};
