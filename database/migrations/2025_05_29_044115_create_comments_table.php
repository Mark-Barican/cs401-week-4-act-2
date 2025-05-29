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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment_content ')->comment('The content of the comment');
            $table->timestamp('comment_date')->comment('The date and time when the comment was made');
            $table->string('reviewer_name')->comment('The name of the person who made the comment');
            $table->string('reviewer_name_email')->comment('The email of the person who made the comment');
            $table->boolean('is_hidden')->comment('Indicates if the comment is hidden (true) or visible (false)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
