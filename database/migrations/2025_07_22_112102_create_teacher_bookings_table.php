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
        Schema::create('teacher_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_id');
            $table->string('student_id');
            $table->string('std_name');
            $table->string('std_email');
            $table->string('std_dob');
            $table->string('std_phone');
            $table->string('std_school');
            $table->string('std_address');
            $table->string('std_area');
            $table->string('std_class');
            $table->enum('std_shift',['Morning','Evening','Afternoon']);
            $table->text('std_subject');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_bookings');
    }
};
