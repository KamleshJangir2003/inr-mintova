-- =============================================
-- Single Leg Plan - Database Setup
-- =============================================

-- 1. Single Leg Milestones Definition
CREATE TABLE IF NOT EXISTS `sl_milestones` (
  `id` INT PRIMARY KEY,
  `team_size` INT NOT NULL,
  `income` DECIMAL(10,2) NOT NULL,
  `required_direct` INT NOT NULL DEFAULT 0,
  `daily_percent` DECIMAL(5,2) NOT NULL DEFAULT 2.00,
  `days` INT NOT NULL DEFAULT 50
);

INSERT INTO `sl_milestones` (`id`,`team_size`,`income`,`required_direct`,`daily_percent`,`days`) VALUES
(1,  50,    300.00,   1, 2.00, 30),
(2,  100,   700.00,   2, 2.00, 30),
(3,  200,   1800.00,  2, 2.00, 30),
(4,  400,   4000.00,  1, 2.00, 30),
(5,  700,   7700.00,  1, 2.00, 30),
(6,  1000,  11000.00, 2, 2.00, 30),
(7,  1500,  18000.00, 1, 2.00, 30),
(8,  3000,  36000.00, 0, 2.00, 30),
(9,  5000,  100000.00,0, 2.00, 30),
(10, 10000, 250000.00,0, 2.00, 30);

-- 2. Track which member earned which milestone
CREATE TABLE IF NOT EXISTS `sl_milestone_earned` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `userid` VARCHAR(50) NOT NULL,
  `milestone_id` INT NOT NULL,
  `total_income` DECIMAL(10,2) NOT NULL,
  `daily_amount` DECIMAL(10,2) NOT NULL,
  `days_total` INT NOT NULL DEFAULT 50,
  `days_paid` INT NOT NULL DEFAULT 0,
  `earned_date` DATE NOT NULL,
  `status` ENUM('A','C') DEFAULT 'A',
  UNIQUE KEY `unique_user_milestone` (`userid`, `milestone_id`)
);

-- 3. Single Leg Daily Income Log
CREATE TABLE IF NOT EXISTS `sl_daily_income` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `userid` VARCHAR(50) NOT NULL,
  `milestone_id` INT NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `date` DATE NOT NULL
);

-- 4. Prize Pool Weekly
CREATE TABLE IF NOT EXISTS `sl_prize_pool` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `week_end_date` DATE NOT NULL,
  `total_amount` DECIMAL(10,2) DEFAULT 0.00,
  `achievers_count` INT DEFAULT 0,
  `per_achiever` DECIMAL(10,2) DEFAULT 0.00,
  `distributed` TINYINT DEFAULT 0,
  `created_date` DATE NOT NULL
);

-- 5. Prize Pool Winners Log
CREATE TABLE IF NOT EXISTS `sl_prize_pool_log` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `userid` VARCHAR(50) NOT NULL,
  `pool_id` INT NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `date` DATE NOT NULL
);

-- 6. Rewards Tracking
CREATE TABLE IF NOT EXISTS `sl_rewards` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `userid` VARCHAR(50) NOT NULL,
  `reward_level` INT NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `date` DATE NOT NULL,
  UNIQUE KEY `unique_user_reward` (`userid`, `reward_level`)
);

-- =============================================
-- Update withdrawal settings for new plan
-- UPDATE `imaksoft_settings_withdrawal` SET `charge`=10, `minimum`=100;
-- =============================================
