-- PetTrackQR Database Structure

-- Create database (optional, if already made)
-- CREATE DATABASE pettrackqr_db;
-- USE pettrackqr_db;

-- Table for storing registered pet details
CREATE TABLE `pets` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pet_name` VARCHAR(100) NOT NULL,
  `pet_type` VARCHAR(50) NOT NULL,
  `pet_breed` VARCHAR(100) NOT NULL,
  `pet_age` INT NOT NULL,
  `pet_allergies` VARCHAR(255),
  `pet_photo` VARCHAR(255),
  `owner_email` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Table for storing notifications sent by pet finders
CREATE TABLE `notifications` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pet_id` INT NOT NULL,
  `finder_name` VARCHAR(100) NOT NULL,
  `finder_contact` VARCHAR(150) NOT NULL,
  `message` TEXT NOT NULL,
  `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`pet_id`) REFERENCES `pets`(`id`) ON DELETE CASCADE
);