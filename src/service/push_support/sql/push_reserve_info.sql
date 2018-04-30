CREATE TABLE `push_reserve_info` (
  `reserve_id` int(11) NOT NULL AUTO_INCREMENT,
  `regist_datetime` datetime NOT NULL,
  `regist_user` varchar(48) NOT NULL,
  `service_name` varchar(48) NOT NULL,
  `push_time` tinyint(1) NOT NULL DEFAULT '2',
  `push_date` date NOT NULL,
  `push_title` varchar(128) NOT NULL,
  `push_body` varchar(320) NOT NULL,
  `push_url` varchar(320) NOT NULL,
  `sent_datetime` datetime DEFAULT NULL,
  `sent_android_flag` tinyint(1) NOT NULL,
  `sent_ios_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`reserve_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;