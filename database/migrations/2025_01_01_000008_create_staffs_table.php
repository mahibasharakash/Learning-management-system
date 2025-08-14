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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('joining_date');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('reset_code')->nullable();
            $table->string('educational_qualification')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
