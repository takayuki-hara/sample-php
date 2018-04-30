CREATE TABLE `setting_info` (
  `morning_time` time NOT NULL,
  `day_time` time NOT NULL,
  `night_time` time NOT NULL,
  `enable_android` tinyint(1) NOT NULL,
  `enable_ios` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;