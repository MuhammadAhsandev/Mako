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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('NIP', 20)->unique();
            $table->string('email')->unique();
            $table->string('alamat', 255)->nullable();
            $table->string('no_telp', 15)->nullable();
            $table->enum('role', ['bk', 'walikelas']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
