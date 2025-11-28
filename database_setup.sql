-- Create the database
CREATE DATABASE IF NOT EXISTS `diugym_db`;

-- Use the database
USE `diugym_db`;

-- Create the users table
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `fullname` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `phone` VARCHAR(20) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
)

-- add new to the users table

ALTER TABLE users 
ADD address VARCHAR(255) NULL,
ADD dob DATE NULL,
ADD gender VARCHAR(20) NULL,
ADD bio TEXT NULL;
