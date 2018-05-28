# Dump of table autocomplete
# ------------------------------------------------------------

DROP TABLE IF EXISTS `autocomplete`;

CREATE TABLE `autocomplete` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `visited` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `autocomplete` WRITE;

INSERT INTO `autocomplete` (`id`, `name`, `visited`)
VALUES
	(1,'toyota version',1),
	(2,'toyota modelo 2018',5),
	(3,'automovil',1),
	(4,'automovil deportivo',2);

UNLOCK TABLES;

