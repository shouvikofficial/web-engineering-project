-- 1. Create and Select Database
CREATE DATABASE IF NOT EXISTS `diugym_db`;
USE `diugym_db`;

-- ==========================================
-- 2. Core Tables (Users & Auth)
-- ==========================================

-- Users Table: Stores login info and roles
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `fullname` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `phone` VARCHAR(20) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'member') DEFAULT 'member', 
    `profile_img` VARCHAR(255) DEFAULT 'default_user.png',
    `address` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- ==========================================
-- 3. Membership & Subscriptions System
-- ==========================================

-- Pricing Plans: Stores the plan details (from your index.html)
CREATE TABLE IF NOT EXISTS `pricing_plans` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `plan_name` VARCHAR(50) NOT NULL, -- e.g., 'Starter', 'Plus', 'Premium'
    `price` DECIMAL(10, 2) NOT NULL,  -- e.g., 2500.00
    `duration_days` INT DEFAULT 30,   -- Default 30 days
    `features` TEXT,                  -- JSON or comma-separated list of features
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- Subscriptions: Tracks which user has which plan and when it expires
CREATE TABLE IF NOT EXISTS `subscriptions` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `plan_id` INT NOT NULL,
    `start_date` DATE NOT NULL,
    `end_date` DATE NOT NULL,
    `status` ENUM('active', 'expired', 'cancelled') DEFAULT 'active',
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`plan_id`) REFERENCES `pricing_plans`(`id`),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- Payments: History of payments made by users
CREATE TABLE IF NOT EXISTS `payments` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `subscription_id` INT NOT NULL,
    `amount` DECIMAL(10, 2) NOT NULL,
    `transaction_id` VARCHAR(100), -- e.g., bKash TrxID
    `payment_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `status` ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
    FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions`(`id`),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- ==========================================
-- 4. Gym Management (Trainers & Classes)
-- ==========================================

-- Trainers: Staff profiles
CREATE TABLE IF NOT EXISTS `trainers` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `specialty` VARCHAR(100) NOT NULL, -- e.g., 'Weight Loss', 'Body Building'
    `experience` VARCHAR(50),          -- e.g., '5 Years'
    `image` VARCHAR(255) DEFAULT 'default_trainer.png',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- Classes: Available gym classes
CREATE TABLE IF NOT EXISTS `gym_classes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `class_name` VARCHAR(100) NOT NULL, -- e.g., 'Yoga', 'HIIT'
    `trainer_id` INT,
    `schedule_day` VARCHAR(20),         -- e.g., 'Monday'
    `start_time` TIME,
    `end_time` TIME,
    `capacity` INT DEFAULT 20,
    FOREIGN KEY (`trainer_id`) REFERENCES `trainers`(`id`) ON DELETE SET NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- Class Bookings: Users booking a slot in a class
CREATE TABLE IF NOT EXISTS `class_bookings` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `class_id` INT NOT NULL,
    `booking_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`class_id`) REFERENCES `gym_classes`(`id`) ON DELETE CASCADE,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- ==========================================
-- 5. General Data
-- ==========================================

-- Contact Messages: Stores messages from the contact form
CREATE TABLE IF NOT EXISTS `messages` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `message` TEXT NOT NULL,
    `submitted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- ==========================================
-- 6. Default Data Seeding
-- ==========================================

-- Insert Default Pricing Plans (Matches your index.html)
INSERT INTO `pricing_plans` (`plan_name`, `price`, `features`) VALUES
('Starter', 2500.00, 'Gym floor access, 2 classes per week, Monthly check-in'),
('Plus', 4000.00, 'Unlimited gym access, Unlimited classes, Workout plan'),
('Premium', 6500.00, 'All Plus features, 1-on-1 coaching, Nutrition plan');


-- Insert Sample Trainers
INSERT INTO `trainers` (`name`, `specialty`) VALUES 
('Nehal S.', 'Strength Coach'), 
('Sadia K.', 'Nutrition Specialist'), 
('Ayan A.', 'HIIT Instructor');


-- add new to the users table

ALTER TABLE users 
ADD address VARCHAR(255) NULL,
ADD dob DATE NULL,
ADD gender VARCHAR(20) NULL,
ADD bio TEXT NULL;
