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
        Schema::create('library_assets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subject');
            $table->string('author_name');
            $table->string('publish_date');
            $table->string('department')->nullable();
            $table->string('asset_type');
            $table->string('purchase_date');
            $table->string('price');
            $table->string('status');
            $table->longText('asset_details');
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_assets');
    }
};
