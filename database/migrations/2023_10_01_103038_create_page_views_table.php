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

        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id'); // Use unsignedInteger for website_id
            $table->timestamp('created_at');  // This will create `created_at` and `updated_at` columns
            $table->string('referrer', 255)->default('');
            $table->string('target', 255)->default('');

            // Add relationship
            $table->foreign('website_id')->references('id')->on('websites');

            // Add indexes
            $table->index('referrer');
            $table->index('target');

            // Add index for timestamp as well, since we will use this for analytics
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
