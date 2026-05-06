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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('org_name')->nullable();;        // təşkilat adı
            $table->date('start_date')->nullable();;        // başlama tarixi
            $table->date('end_date')->nullable(); // bitmə tarixi (boş ola bilər)
            $table->string('major')->nullable();;          // ixtisas
            $table->string('doc_number')->nullable(); // sənəd nömrəsi
            $table->date('doc_date')->nullable();
            $table->string('doc_path')->nullable();        // fayl yolu

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('education_type_id')
                ->nullable()
                ->constrained('education_types')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
