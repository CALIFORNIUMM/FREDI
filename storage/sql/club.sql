SET FOREIGN_KEY_CHECKS = 0;
USE fredi21;
DROP TABLE IF EXISTS club;

CREATE TABLE `club` (
`id_club` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`lib_club` varchar(50) DEFAULT NULL,
`adr1` varchar(50) DEFAULT NULL,
`adr2` varchar(50) DEFAULT NULL,
`adr3` varchar(50) DEFAULT NULL,
`id_ligue` int(11) NOT NULL,
CONSTRAINT `fk_id_ligue` FOREIGN KEY (`id_ligue`) REFERENCES `ligue` (`id_ligue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



SET FOREIGN_KEY_CHECKS = 1;