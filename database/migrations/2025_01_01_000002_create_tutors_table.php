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
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('reset_code')->nullable();
            $table->string('joining_date');
            $table->string('gender');
            $table->string('designation');
            $table->string('mobile_number');
            $table->string('department')->nullable();
            $table->string('date_of_birth');
            $table->string('address');
            $table->string('educational_qualification');
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};
