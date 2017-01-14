CREATE TABLE IF NOT EXISTS `wcellar_wine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(127) DEFAULT NULL,
  `region` varchar(127) DEFAULT NULL,
  `name` varchar(127) DEFAULT NULL,
  `producer` varchar(127) DEFAULT NULL,
  `color` varchar(127) DEFAULT NULL,
  `comment` TEXT DEFAULT NULL,
  `recommended_dish` TEXT DEFAULT NULL,
  `advise` TEXT DEFAULT NULL,
  `configuration` TEXT DEFAULT NULL,
  UNIQUE INDEX `wine_UNIQUE` (`country` ASC,`region` ASC,`name` ASC,`producer` ASC,`color` ASC),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `wcellar_cellar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wine_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `cost` float(2) DEFAULT NULL,
  `position` TEXT DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `comment` TEXT DEFAULT NULL,
  `advise` TEXT DEFAULT NULL,
  `recommended_dish` TEXT DEFAULT NULL,
  `configuration` TEXT DEFAULT NULL,
  `image` TEXT DEFAULT NULL,
  UNIQUE INDEX `wine_year_UNIQUE` (`wine_id` ASC,`year` ASC),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `wcellar_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cellar_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `comment` TEXT DEFAULT NULL,
  `configuration` TEXT DEFAULT NULL,
  UNIQUE INDEX `cellar_date_UNIQUE` (`cellar_id` ASC,`date` ASC),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;