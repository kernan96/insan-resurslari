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
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();  // İstifadəçi ilə əlaqə
            $table->foreignId('phone_type_id')
            ->constrained('phone_types')
            ->cascadeOnDelete();  // Telefon növü
            $table->string('number');  // Telefon nömrəsi
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phones');
    }
};
