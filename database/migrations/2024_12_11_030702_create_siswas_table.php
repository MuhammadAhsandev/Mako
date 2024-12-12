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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('NISN')->unique();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->string('email')->unique();
            $table->string('alamat', 255)->nullable();
            $table->string('no_telp',15);
            $table->foreignId('orangtua_id')->constrained('orangtuas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
