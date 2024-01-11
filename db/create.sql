/*User's table*/
CREATE TABLE `User` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `surname` VARCHAR(50) NOT NULL,
    `username` VARCHAR(50) UNIQUE NOT NULL,
    `password` VARCHAR(100) NOT NULL, -- Note: Passwords should be hashed for security
    `date_of_birth` DATE NOT NULL,
    `gender` ENUM('Male', 'Female', 'Neutral')
);

/*Post Table*/
CREATE TABLE `Post` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `image` VARCHAR(100) NOT NULL,
    `posted` DATETIME NOT NULL,
    `comment` TEXT,
    FOREIGN KEY (`user_id`) REFERENCES `User`(`id`)
);

/*Item Table*/
CREATE TABLE `Item` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `post_id` INT,
    `name` VARCHAR(100) NOT NULL,
    `brand` VARCHAR(100) NOT NULL,
    `link` VARCHAR(255), -- Assuming a URL link for the item
    `size` VARCHAR(50) NOT NULL,
    `price` FLOAT(6, 2), -- Assuming a decimal data type for price
    `currency` VARCHAR(10),
    `x` FLOAT NOT NULL, -- Assuming numeric coordinates for x and y
    `y` FLOAT NOT NULL,
    FOREIGN KEY (`post_id`) REFERENCES `Post`(`id`)
);

/*Like Table*/
CREATE TABLE `Like` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `post_id` INT NOT NULL,
    `date_liked` DATETIME NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `User`(`id`),
    FOREIGN KEY (`post_id`) REFERENCES `Post`(`id`)
);
/*Comment Table*/
CREATE TABLE `Comment` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `post_id` INT NOT NULL,
    `comment_text` TEXT NOT NULL,
    `date_posted` DATETIME NOT NULL, 
    FOREIGN KEY (`user_id`) REFERENCES `User`(`id`),
    FOREIGN KEY (`post_id`) REFERENCES `Post`(`id`)
);
/*Star Table*/
CREATE TABLE `Star` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `post_id` INT NOT NULL,
    `date_starred` DATETIME NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `User`(`id`),
    FOREIGN KEY (`post_id`) REFERENCES `Post`(`id`)
);

/* Notifications. */
CREATE TABLE `Notification` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `notification_type` ENUM('liked', 'starred', 'commented'),
    `from_user_id` INT NOT NULL,
    `to_user_id` INT NOT NULL,
    `post_id` INT NOT NULL,
    `seen` BOOLEAN DEFAULT 0 NOT NULL,  -- Modificato il valore predefinito
    `date_posted` DATETIME NOT NULL,
    FOREIGN KEY (`from_user_id`) REFERENCES `User`(`id`),
    FOREIGN KEY (`to_user_id`) REFERENCES `User`(`id`),
    FOREIGN KEY (`post_id`) REFERENCES `Post`(`id`)
);

