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
        Schema::create('organization_departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('organization_type_id')
                ->constrained('organization_types')
                ->cascadeOnDelete();
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('organization_departments')
                ->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->string('short_name')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('fax')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_departments');
    }
};
