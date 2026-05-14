-- Run this SQL in phpMyAdmin

CREATE TABLE IF NOT EXISTS `imaksoft_settings_qr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wallet_address` varchar(255) NOT NULL DEFAULT '',
  `qr_image` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `imaksoft_settings_qr` (`wallet_address`, `qr_image`) 
SELECT 'YOUR_USDT_TRC20_ADDRESS', '' 
WHERE NOT EXISTS (SELECT 1 FROM `imaksoft_settings_qr`);

-- Add screenshot column to mi_member_payment if not exists
ALTER TABLE `mi_member_payment` ADD COLUMN IF NOT EXISTS `screenshot` varchar(255) DEFAULT '' AFTER `tranid`;
