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
        Schema::create('user_relatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('relationship_type_id')
                ->nullable()
                ->constrained('relationship_types')
                ->nullOnDelete();
            $table->string('full_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('workplace')->nullable();
            $table->string('position')->nullable();
            $table->string('registered_address')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_relatives');
    }
};
