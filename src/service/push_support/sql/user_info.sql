CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(48) NOT NULL,
  `pass_word` varchar(48) NOT NULL,
  `regist_datetime` datetime NOT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;