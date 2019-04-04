DROP SCHEMA IF EXISTS `doctrine`;
CREATE SCHEMA `doctrine`
DEFAULT CHARACTER SET utf8mb4
DEFAULT COLLATE utf8mb4_unicode_ci;
-- CREATE USER 'root'@'%' identified by 'magic';
GRANT ALL ON `doctrine`.* TO 'root'@'%';
