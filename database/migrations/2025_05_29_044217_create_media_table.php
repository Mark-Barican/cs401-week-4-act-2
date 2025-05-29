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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->comment('The name of the media file');
            $table->string('file_type')->comment('The type of the media file (e.g., image, video, audio)');
            $table->integer('file_size')->comment('The size of the media file in bytes');
            $table->string('url')->comment('The URL where the media file is stored');
            $table->timestamp('upload_date')->comment('The date and time when the media file was uploaded');
            $table->string('description')->comment('A brief description of the media file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
