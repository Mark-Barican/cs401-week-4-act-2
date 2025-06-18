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
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        echo "Starting database seeding with 5K+ records...\n";

        // Create roles
        echo "Creating roles...\n";
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

        // Create categories (50 categories)
        echo "Creating 50 categories...\n";
        $categories = [];
        $categoryNames = [
            'Technology', 'Programming', 'Web Development', 'Mobile Apps', 'Data Science',
            'Artificial Intelligence', 'Machine Learning', 'Cybersecurity', 'Cloud Computing', 'DevOps',
            'Travel', 'Food', 'Health', 'Fitness', 'Lifestyle',
            'Business', 'Finance', 'Marketing', 'Entrepreneurship', 'Productivity',
            'Education', 'Science', 'Research', 'Innovation', 'Startups',
            'Gaming', 'Entertainment', 'Movies', 'Music', 'Books',
            'Sports', 'Football', 'Basketball', 'Tennis', 'Swimming',
            'Photography', 'Art', 'Design', 'Fashion', 'Architecture',
            'Environment', 'Sustainability', 'Nature', 'Climate Change', 'Renewable Energy',
            'Politics', 'News', 'Current Events', 'Society', 'Culture'
        ];

        foreach ($categoryNames as $index => $name) {
            $categories[] = Category::create([
                'category_name' => $name,
                'slug' => strtolower(str_replace(' ', '-', $name)),
                'description' => "All about {$name} and related topics"
            ]);
        }

        // Create tags (100 tags)
        echo "Creating 100 tags...\n";
        $tags = [];
        $tagNames = [
            'PHP', 'Laravel', 'MySQL', 'JavaScript', 'Python', 'React', 'Vue', 'Angular', 'Node.js', 'Express',
            'MongoDB', 'PostgreSQL', 'Redis', 'Docker', 'Kubernetes', 'AWS', 'Azure', 'Google Cloud', 'Git', 'GitHub',
            'HTML', 'CSS', 'Bootstrap', 'Tailwind', 'SASS', 'jQuery', 'TypeScript', 'JSON', 'API', 'REST',
            'GraphQL', 'Microservices', 'Architecture', 'Design Patterns', 'Clean Code', 'Testing', 'TDD', 'BDD', 'CI/CD', 'Agile',
            'Scrum', 'Project Management', 'Leadership', 'Team Building', 'Communication', 'Productivity', 'Time Management', 'Goals', 'Success', 'Motivation',
            'Travel', 'Adventure', 'Backpacking', 'Budget Travel', 'Luxury Travel', 'Solo Travel', 'Family Travel', 'Business Travel', 'Digital Nomad', 'Remote Work',
            'Food', 'Cooking', 'Recipes', 'Healthy Eating', 'Nutrition', 'Diet', 'Fitness', 'Exercise', 'Yoga', 'Meditation',
            'Mental Health', 'Wellness', 'Self Care', 'Mindfulness', 'Personal Growth', 'Learning', 'Education', 'Online Courses', 'Books', 'Reading',
            'Writing', 'Blogging', 'Content Creation', 'Social Media', 'Marketing', 'SEO', 'Analytics', 'Growth Hacking', 'Startups', 'Business',
            'Finance', 'Investment', 'Cryptocurrency', 'Blockchain', 'NFT', 'Fintech', 'Banking', 'Economy', 'Money Management', 'Saving'
        ];

        foreach ($tagNames as $name) {
            $tags[] = Tag::create([
                'tag_name' => $name,
                'slug' => strtolower(str_replace([' ', '.'], ['-', ''], $name))
            ]);
        }

        // Create users (1000 users)
        echo "Creating 1000 users...\n";
        $users = [];
        $firstNames = ['John', 'Jane', 'Mike', 'Sarah', 'David', 'Emily', 'Chris', 'Lisa', 'Mark', 'Anna', 'James', 'Maria', 'Robert', 'Jessica', 'William'];
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez', 'Hernandez', 'Lopez', 'Gonzalez', 'Wilson', 'Anderson'];
        $domains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'example.com'];

        for ($i = 1; $i <= 1000; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $domain = $domains[array_rand($domains)];
            
            $user = User::create([
                'name' => "{$firstName} {$lastName}",
                'email' => strtolower("{$firstName}.{$lastName}.{$i}@{$domain}"),
                'password' => bcrypt('password'),
                'registration_date' => now()->subDays(rand(1, 365)),
                'last_login_date' => now()->subDays(rand(0, 30)),
            ]);

            // Assign random role to user
            $role = [$adminRole, $contributorRole, $subscriberRole][rand(0, 2)];
            $user->roles()->attach($role->id);
            
            $users[] = $user;
        }

        // Create posts (2000 posts)
        echo "Creating 2000 posts...\n";
        $posts = [];
        $postTitles = [
            'Getting Started with', 'Advanced Techniques in', 'Best Practices for', 'Complete Guide to', 'Introduction to',
            'Mastering', 'Understanding', 'Building Better', 'Optimizing', 'Troubleshooting',
            'Top 10 Tips for', 'Common Mistakes in', 'Future of', 'Trends in', 'How to Learn'
        ];
        $techTopics = ['Laravel Development', 'React Applications', 'Database Design', 'API Development', 'Cloud Computing'];
        $generalTopics = ['Project Management', 'Remote Work', 'Digital Marketing', 'Content Creation', 'Personal Branding'];

        for ($i = 1; $i <= 2000; $i++) {
            $titlePrefix = $postTitles[array_rand($postTitles)];
            $topic = ($i % 2 == 0) ? $techTopics[array_rand($techTopics)] : $generalTopics[array_rand($generalTopics)];
            $title = "{$titlePrefix} {$topic}";
            
            $post = Post::create([
                'title' => $title,
                'content' => "This is a comprehensive article about {$topic}. " . str_repeat("Lorem ipsum dolor sit amet, consectetur adipiscing elit. ", rand(20, 100)),
                'slug' => strtolower(str_replace(' ', '-', $title)) . '-' . $i,
                'publication_date' => now()->subDays(rand(1, 180)),
                'last_modified_date' => now()->subDays(rand(0, 30)),
                'status' => ['P', 'D', 'I'][rand(0, 2)],
                'featured_image' => "https://picsum.photos/800/600?random={$i}",
                'views_count' => rand(10, 5000),
                'user_id' => $users[array_rand($users)]->id
            ]);

            // Assign random categories (1-3 categories per post)
            $categoryCount = rand(1, 3);
            $randomCategories = array_rand($categories, $categoryCount);
            if (!is_array($randomCategories)) {
                $randomCategories = [$randomCategories];
            }
            foreach ($randomCategories as $catIndex) {
                $post->categories()->attach($categories[$catIndex]->id);
            }

            // Assign random tags (2-5 tags per post)
            $tagCount = rand(2, 5);
            $randomTags = array_rand($tags, $tagCount);
            if (!is_array($randomTags)) {
                $randomTags = [$randomTags];
            }
            foreach ($randomTags as $tagIndex) {
                $post->tags()->attach($tags[$tagIndex]->id);
            }

            $posts[] = $post;
        }

        // Create comments (3000 comments)
        echo "Creating 3000 comments...\n";
        $commentTexts = [
            'Great article! Very informative and well written.',
            'Thanks for sharing this. It helped me understand the topic better.',
            'I have a question about the implementation details.',
            'This is exactly what I was looking for. Bookmarked!',
            'Could you provide more examples on this topic?',
            'Excellent explanation. Looking forward to more content like this.',
            'I disagree with some points, but overall a good read.',
            'Very detailed tutorial. Following along step by step.',
            'This saved me hours of research. Thank you!',
            'Any recommendations for further reading on this subject?'
        ];

        for ($i = 1; $i <= 3000; $i++) {
            $user = $users[array_rand($users)];
            $post = $posts[array_rand($posts)];
            $commentText = $commentTexts[array_rand($commentTexts)];
            
            Comment::create([
                'comment_content' => $commentText . " Comment #{$i}",
                'comment_date' => now()->subDays(rand(0, 90)),
                'reviewer_name' => $user->name,
                'reviewer_name_email' => $user->email,
                'is_hidden' => rand(0, 10) > 8, // 20% chance of being hidden
                'user_id' => $user->id,
                'post_id' => $post->id
            ]);
        }

        // Create media files (1500 media files)
        echo "Creating 1500 media files...\n";
        $fileTypes = ['image', 'video', 'audio', 'document'];
        $fileExtensions = [
            'image' => ['jpg', 'png', 'gif', 'svg', 'webp'],
            'video' => ['mp4', 'avi', 'mov', 'wmv', 'flv'],
            'audio' => ['mp3', 'wav', 'flac', 'aac', 'ogg'],
            'document' => ['pdf', 'doc', 'docx', 'txt', 'xlsx']
        ];

        for ($i = 1; $i <= 1500; $i++) {
            $post = $posts[array_rand($posts)];
            $fileType = $fileTypes[array_rand($fileTypes)];
            $extension = $fileExtensions[$fileType][array_rand($fileExtensions[$fileType])];
            $fileName = "media_file_{$i}.{$extension}";
            
            Media::create([
                'file_name' => $fileName,
                'file_type' => $fileType,
                'file_size' => rand(1024, 10485760), // 1KB to 10MB
                'url' => "https://example.com/media/{$fileName}",
                'upload_date' => now()->subDays(rand(0, 60)),
                'description' => "Media file for {$post->title}",
                'post_id' => $post->id
            ]);
        }

        echo "\nDatabase seeding completed successfully!\n";
        echo "Summary of created records:\n";
        echo "- Roles: 3\n";
        echo "- Categories: 50\n";
        echo "- Tags: 100\n";
        echo "- Users: 1,000\n";
        echo "- Posts: 2,000\n";
        echo "- Comments: 3,000\n";
        echo "- Media Files: 1,500\n";
        echo "- Total Records: 7,653\n";
        echo "- Relationship Records: " . (1000 + 2000*2.5 + 2000*3.5) . " (approx)\n";
    }
}
