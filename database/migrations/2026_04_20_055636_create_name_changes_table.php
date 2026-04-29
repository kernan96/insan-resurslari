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
        Schema::create('name_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();  // Hangi istifadəçiyə aid olduğunu göstərir
            $table->string('old_first_name');  // Köhnə ad
            $table->string('old_last_name');   // Köhnə soyad
            $table->string('old_father_name');   // Köhnə ata adi
            $table->text('reason');  // Dəyişiklik səbəbi
            $table->date('date');  // Dəyişiklik tarixi
            $table->timestamps();  // Yaradılma və yenilənmə tarixləri
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('name_changes');
    }
};
