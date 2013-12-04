CREATE DATABASE transfer;

USE transfer;

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) unsigned NOT NULL auto_increment,
  `user_login` varchar(100) NOT NULL,
  `user_password` varchar(64) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_surname` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_registered` datetime NOT NULL default '0000-00-00 00:00:00',  
  PRIMARY KEY (`user_id`),
  KEY `idx_user_login_key` (`user_login`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL REFERENCES `users`(`user_id`),
  `task_name` varchar(20) NOT NULL,
  `task_club` varchar(20) NOT NULL,
  `task_pos` varchar(20) NOT NULL,
  `task_age` varchar(2) NOT NULL,
  `task_dob` date NOT NULL,
  `task_weight` varchar(3) NOT NULL,
  `task_exp` varchar(7) NOT NULL default '#ffffff',
  PRIMARY KEY (`task_id`),
  KEY `idx_task_name_key` (`task_name`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `articles` (
  `article_id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL REFERENCES `users`(`user_id`),
  `article_headline` varchar(40) NOT NULL,
  `article_image` varchar(20) NOT NULL,
  `article_caption` varchar(60) NOT NULL,
  `article_text` varchar(1000) NOT NULL,
  PRIMARY KEY (`article_id`),
  KEY `idx_article_headline_key` (`article_headline`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


INSERT INTO `users` ( `user_login`, `user_password`, `user_firstname`, 
	`user_surname`, `user_email`, `user_registered` )
SELECT 'stuart', PASSWORD('password'), 'Stuart',
	'Byrne', 'strtbyrne@gmail.com', NOW();
    
INSERT INTO `users` ( `user_login`, `user_password`, `user_firstname`, 
	`user_surname`, `user_email`, `user_registered` )
SELECT 'admin', PASSWORD('pfai'), 'Admin',
	'PFAI', 'info@pfai.ie', NOW();
	
CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` bigint(20) NOT NULL REFERENCES `users`(`user_id`),
  `session_key` varchar(60) NOT NULL,
  `session_address` varchar(100) NOT NULL,
  `session_useragent` varchar(200) NOT NULL,
  `session_expires` datetime NOT NULL default '0000-00-00 00:00:00',  
  PRIMARY KEY (`session_id`),
  KEY `idx_session_key` (`session_key`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;