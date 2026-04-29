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
        Schema::create('user_party_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string('party_name');
            $table->string('party_short_name')->nullable();
            $table->boolean('is_member')->default(true);
            $table->date('member_since')->nullable();
            $table->date('ended_at')->nullable();
            $table->string('member_no')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_party_memberships');
    }
};
