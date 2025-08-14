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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('registration_date');
            $table->string('roll_id');
            $table->string('course');
            $table->string('gender');
            $table->string('reset_code')->nullable();
            $table->string('mobile_number');
            $table->string('blood_group');
            $table->string('date_of_birth');
            $table->string('parent_name');
            $table->string('parent_mobile_number');
            $table->string('address');
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
