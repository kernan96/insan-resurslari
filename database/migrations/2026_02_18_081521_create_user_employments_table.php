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
        Schema::create('user_employments', function (Blueprint $table) {
            $table->id();
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('ended_date')->nullable();
            $table->boolean('status')->default(true);
            $table->string('contract_no')->nullable();
            // $table->integer('term_months')->nullable();
            $table->text('note')->nullable();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('emp_type_id')
                ->constrained('employment_types');
            $table->timestamps();
            $table->foreignId('position_id')
                ->nullable()
                ->constrained('positions')
                ->nullOnDelete();
            $table->foreignId('organization_id')
                ->nullable()
                ->constrained('organization_departments')
                ->nullOnDelete();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_employments');
    }
};
