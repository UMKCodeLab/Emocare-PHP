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
            $table->string('username');
            $table->enum('role',['user','psikiater','admin'])->default('user');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('image')->nullable();
            $table->string('password');
            $table->text('status')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->rememberToken();
            $table->timestamps();

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
