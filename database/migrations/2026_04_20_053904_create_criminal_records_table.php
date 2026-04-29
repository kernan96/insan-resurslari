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
        Schema::create('criminal_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();
            $table->text('reason')->nullable();  // Cinayət səbəbi
            $table->date('date');  // Cinayətin tarixi
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criminal_records');
    }
};
