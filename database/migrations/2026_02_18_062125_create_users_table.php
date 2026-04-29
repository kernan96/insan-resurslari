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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('fin', 10)->unique()->nullable();
            $table->boolean('gender');
            $table->date('birth_date')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            // $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->foreignId('role_id')
                ->nullable()
                ->constrained('roles')
                ->nullOnDelete();
            $table->foreignId('org_position_id')
                ->nullable()
                ->constrained('org_positions')
                ->nullOnDelete();
            $table->rememberToken();
            $table->timestamps();
            $table->string('profile_photo_path')->nullable();
            $table->string('registered_address')->nullable();
            $table->string('residential_address')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('citizen')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('sin')->nullable();
            $table->text('note')->nullable();
            $table->boolean('marital_status')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
