CREATE TABLE `User` (
    `username` VARCHAR(50) PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `surname` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL, 
    `date_of_birth` DATE NOT NULL,
    `gender` ENUM('Male', 'Female', 'Neutral'),
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `profile_image` VARCHAR(255) NOT NULL 
);

/* Post Table */
CREATE TABLE `Post` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_username` VARCHAR(50) NOT NULL,
    `image` VARCHAR(100) NOT NULL,
    `posted` DATETIME NOT NULL,
    `comment` TEXT,
    FOREIGN KEY (`user_username`) REFERENCES `User`(`username`)
);

/* Item Table */
CREATE TABLE `Item` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `post_id` INT NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `brand` VARCHAR(100) NOT NULL,
    `link` VARCHAR(255),
    `size` VARCHAR(50) NOT NULL,
    `price` FLOAT(6, 2),
    `currency` VARCHAR(10),
    `x` FLOAT NOT NULL,
    `y` FLOAT NOT NULL,
    FOREIGN KEY (`post_id`) REFERENCES `Post`(`id`)
);
/* Like Table */
CREATE TABLE `Like` (
    `user_username` VARCHAR(50) NOT NULL,
    `post_id` INT NOT NULL,
    `date_liked` DATETIME NOT NULL,
    PRIMARY KEY (`post_id`, `user_username`),
    FOREIGN KEY (`user_username`) REFERENCES `User`(`username`),
    FOREIGN KEY (`post_id`) REFERENCES `Post`(`id`)
);

/* Comment Table */
CREATE TABLE `Comment` (
    `user_username` VARCHAR(50) NOT NULL,
    `post_id` INT NOT NULL,
    `comment_text` TEXT NOT NULL,
    `date_posted` DATETIME NOT NULL,
    PRIMARY KEY (`post_id`, `user_username`),
    FOREIGN KEY (`user_username`) REFERENCES `User`(`username`),
    FOREIGN KEY (`post_id`) REFERENCES `Post`(`id`)
);

/* Star Table */
CREATE TABLE `Star` (
    `user_username` VARCHAR(50) NOT NULL,
    `post_id` INT NOT NULL,
    `date_starred` DATETIME NOT NULL,
    PRIMARY KEY (`post_id`, `user_username`),
    FOREIGN KEY (`user_username`) REFERENCES `User`(`username`),
    FOREIGN KEY (`post_id`) REFERENCES `Post`(`id`)
);

/* Notifications Table */
CREATE TABLE `Notification` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `notification_type` ENUM('liked', 'starred', 'commented'),
    `from_user_username` VARCHAR(50) NOT NULL,
    `to_user_username` VARCHAR(50) NOT NULL,
    `post_id` INT NOT NULL,
    `seen` BOOLEAN DEFAULT 0 NOT NULL,
    `date_posted` DATETIME NOT NULL,
    FOREIGN KEY (`from_user_username`) REFERENCES `User`(`username`),
    FOREIGN KEY (`to_user_username`) REFERENCES `User`(`username`),
    FOREIGN KEY (`post_id`) REFERENCES `Post`(`id`)
);

CREATE TABLE `Follow` (
    `follower_username` VARCHAR(50),
    `following_username` VARCHAR(50),
    PRIMARY KEY (`follower_username`, `following_username`),
    FOREIGN KEY (`follower_username`) REFERENCES `User`(`username`),
    FOREIGN KEY (`following_username`) REFERENCES `User`(`username`)
);