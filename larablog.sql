-- Table des catégories
CREATE TABLE categories (
    `id` bigint(20) PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des tags
CREATE TABLE tags (
    `id` bigint(20) PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des articles
CREATE TABLE articles (
    `id` bigint(20) PRIMARY KEY AUTO_INCREMENT,
    `user_id` bigint UNSIGNED,
    `title` VARCHAR(255) NOT NULL,
    `content` TEXT NOT NULL,
    `draft` BOOLEAN DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table pivot pour la relation many-to-many entre articles et catégories
CREATE TABLE article_category (
    `article_id` bigint(20),
    `category_id` bigint(20),
    FOREIGN KEY (article_id) REFERENCES articles(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Table pivot pour la relation many-to-many entre articles et tags
CREATE TABLE article_tag (
    `article_id` bigint(20),
    `tag_id` bigint(20),
    FOREIGN KEY (article_id) REFERENCES articles(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);

-- Table des commentaires
CREATE TABLE comments (
    `id` bigint(20) PRIMARY KEY AUTO_INCREMENT,
    `user_id` bigint UNSIGNED,
    `article_id` bigint(20),
    `content` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (article_id) REFERENCES articles(id)
);