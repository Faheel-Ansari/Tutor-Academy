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
        Schema::create('teacher_profile', function (Blueprint $table) {
            $table->id();
            $table->string('role_id');
            $table->string('fullname');
            $table->string('fname');
            $table->string('phone_no');
            $table->string('qualification');
            $table->string('email');
            $table->string('address');
            $table->string('experience');
            $table->string('cnic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_profile');
    }
};
