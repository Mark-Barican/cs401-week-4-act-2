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
        //
        Schema::table('users', function(Blueprint $table) {
            $table->string('name')->comment('user name.')->max(30)->change();
        });
        Schema::table('roles', function(Blueprint $table) {
            $table->string('role_name')->comment('A - Admin, C - Contributor, S - Subscriber')->max(1)->change();
        });
        Schema::table('posts', function(Blueprint $table) {
            $table->text('content')->comment('comment of the post.')->change();
        });
        Schema::table('posts', function(Blueprint $table) {
            $table->text('content')->comment('comment of the post.')->change();
            $table->string('status')->comment('status of post.')->change();
            $table->text('featured_image')->comment('feature image url')->change();
        });
        Schema::table('categories', function(Blueprint $table) {
            $table->text('category_name')->comment('name of category.')->max(30)->change();
        });
        Schema::table('tags', function(Blueprint $table) {
            $table->string('tag_name')->comment('name of tag.')->max(45)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};