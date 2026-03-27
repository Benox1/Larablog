<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE TABLE IF NOT EXISTS categories (
                `id` bigint(20) PRIMARY KEY AUTO_INCREMENT,
                `name` VARCHAR(255) NOT NULL,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ");

        DB::statement("
            CREATE TABLE IF NOT EXISTS tags (
                `id` bigint(20) PRIMARY KEY AUTO_INCREMENT,
                `name` VARCHAR(255) NOT NULL,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ");

        DB::statement("
            CREATE TABLE IF NOT EXISTS articles (
                `id` bigint(20) PRIMARY KEY AUTO_INCREMENT,
                `user_id` bigint UNSIGNED,
                `title` VARCHAR(255) NOT NULL,
                `content` TEXT NOT NULL,
                `draft` BOOLEAN DEFAULT 1,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id)
            )
        ");

        DB::statement("
            CREATE TABLE IF NOT EXISTS article_category (
                `article_id` bigint(20),
                `category_id` bigint(20),
                FOREIGN KEY (article_id) REFERENCES articles(id),
                FOREIGN KEY (category_id) REFERENCES categories(id)
            )
        ");

        DB::statement("
            CREATE TABLE IF NOT EXISTS article_tag (
                `article_id` bigint(20),
                `tag_id` bigint(20),
                FOREIGN KEY (article_id) REFERENCES articles(id),
                FOREIGN KEY (tag_id) REFERENCES tags(id)
            )
        ");

        DB::statement("
            CREATE TABLE IF NOT EXISTS comments (
                `id` bigint(20) PRIMARY KEY AUTO_INCREMENT,
                `user_id` bigint UNSIGNED,
                `article_id` bigint(20),
                `content` TEXT NOT NULL,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (article_id) REFERENCES articles(id)
            )
        ");
    }

    public function down(): void
    {
        DB::statement('DROP TABLE IF EXISTS article_category');
        DB::statement('DROP TABLE IF EXISTS article_tag');
        DB::statement('DROP TABLE IF EXISTS comments');
        DB::statement('DROP TABLE IF EXISTS articles');
        DB::statement('DROP TABLE IF EXISTS categories');
        DB::statement('DROP TABLE IF EXISTS tags');
    }
};
