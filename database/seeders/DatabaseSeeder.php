<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Media;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create([
            'role_name' => 'A',
            'description' => 'Administrator with full access'
        ]);

        $contributorRole = Role::create([
            'role_name' => 'C',
            'description' => 'Contributor can create and edit posts'
        ]);

        $subscriberRole = Role::create([
            'role_name' => 'S',
            'description' => 'Subscriber can read and comment'
        ]);

        // Create users
        $admin = User::create([
            'name' => 'John Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'registration_date' => now(),
            'last_login_date' => now(),
        ]);

        $contributor = User::create([
            'name' => 'Jane Contributor',
            'email' => 'contributor@example.com',
            'password' => bcrypt('password'),
            'registration_date' => now(),
            'last_login_date' => now(),
        ]);

        $subscriber = User::create([
            'name' => 'Bob Subscriber',
            'email' => 'subscriber@example.com',
            'password' => bcrypt('password'),
            'registration_date' => now(),
            'last_login_date' => now(),
        ]);

        // Assign roles to users
        $admin->roles()->attach($adminRole->id);
        $contributor->roles()->attach($contributorRole->id);
        $subscriber->roles()->attach($subscriberRole->id);

        // Create categories
        $techCategory = Category::create([
            'category_name' => 'Technology',
            'slug' => 'technology',
            'description' => 'All about technology and programming'
        ]);

        $travelCategory = Category::create([
            'category_name' => 'Travel',
            'slug' => 'travel',
            'description' => 'Travel experiences and destinations'
        ]);

        // Create tags
        $phpTag = Tag::create([
            'tag_name' => 'PHP',
            'slug' => 'php'
        ]);
        $laravelTag = Tag::create([
            'tag_name' => 'Laravel',
            'slug' => 'laravel'
        ]);
        $mysqlTag = Tag::create([
            'tag_name' => 'MySQL',
            'slug' => 'mysql'
        ]);

        // Create posts
        $post1 = Post::create([
            'title' => 'Getting Started with Laravel',
            'content' => 'Laravel is a powerful PHP framework for web development...',
            'slug' => 'getting-started-with-laravel',
            'publication_date' => now(),
            'last_modified_date' => now(),
            'status' => 'P',
            'featured_image' => 'https://example.com/laravel-image.jpg',
            'views_count' => 150,
            'user_id' => $contributor->id
        ]);

        $post2 = Post::create([
            'title' => 'Database Migrations in Laravel',
            'content' => 'Migrations are like version control for your database...',
            'slug' => 'database-migrations-laravel',
            'publication_date' => now(),
            'last_modified_date' => now(),
            'status' => 'P',
            'featured_image' => 'https://example.com/migration-image.jpg',
            'views_count' => 200,
            'user_id' => $admin->id
        ]);

        // Associate posts with categories
        $post1->categories()->attach($techCategory->id);
        $post2->categories()->attach($techCategory->id);

        // Associate posts with tags
        $post1->tags()->attach([$phpTag->id, $laravelTag->id]);
        $post2->tags()->attach([$laravelTag->id, $mysqlTag->id]);

        // Create comments
        Comment::create([
            'comment_content' => 'Great tutorial! Very helpful for beginners.',
            'comment_date' => now(),
            'reviewer_name' => 'Alice Review',
            'reviewer_name_email' => 'alice@example.com',
            'is_hidden' => false,
            'user_id' => $subscriber->id,
            'post_id' => $post1->id
        ]);

        Comment::create([
            'comment_content' => 'Can you explain more about rollback migrations?',
            'comment_date' => now(),
            'reviewer_name' => 'Charlie Question',
            'reviewer_name_email' => 'charlie@example.com',
            'is_hidden' => false,
            'user_id' => $subscriber->id,
            'post_id' => $post2->id
        ]);

        // Create media
        Media::create([
            'file_name' => 'laravel-logo.png',
            'file_type' => 'image',
            'file_size' => 15420,
            'url' => 'https://example.com/media/laravel-logo.png',
            'upload_date' => now(),
            'description' => 'Laravel framework logo',
            'post_id' => $post1->id
        ]);

        Media::create([
            'file_name' => 'database-diagram.jpg',
            'file_type' => 'image',
            'file_size' => 25680,
            'url' => 'https://example.com/media/database-diagram.jpg',
            'upload_date' => now(),
            'description' => 'Database relationship diagram',
            'post_id' => $post2->id
        ]);

        echo "Database seeded successfully with sample data!\n";
    }
}
