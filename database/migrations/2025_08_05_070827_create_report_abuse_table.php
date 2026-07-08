<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('report_abuse', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('student_id');
            $table->text('message');
            $table->enum('status', ['0', '1'])->default('0');
            $table->enum('read_no', ['0', '1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_abuse');
    }
};
