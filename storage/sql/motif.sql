SET FOREIGN_KEY_CHECKS = 0;
USE fredi21;
DROP TABLE IF EXISTS `motif`;
CREATE TABLE `motif` (
  `id_motif` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `lib_motif` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS = 1;