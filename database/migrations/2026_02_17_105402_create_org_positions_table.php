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
        Schema::create('org_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_dep_id')
            ->nullable()
            ->constrained('organization_departments')
            ->nullOnDelete();
            $table->foreignId('position_id')
            ->nullable()
            ->constrained('positions')
            ->nullOnDelete();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('org_positions');
    }
};
