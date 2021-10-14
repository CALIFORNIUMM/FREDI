USE fredi21;
INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo`, `mdp`, `mail`, `nom`, `prenom`, `role`) VALUES
(9, 'yohan', '$2y$10$jaa7NnbdBhEuL5hMLGMbteg.KXzsep5/VCVs.Ql9DZj/SYZ45jHdG', 'yohan.marques@limayrac.fr', 'marques', 'yohan', 2),
(10, 'agustin', '$2y$10$ZT6T366PoTdRCNY.8KCYaeL5atqndjRct0ToNsksraYWlRWYC2qa2', 'agustin.quintero@limayrac.fr', 'Quintero', 'Agustin', 2),
(11, 'david', '$2y$10$18jqscpcfns8YHYcYFabl.dIFP7pmLptXd4WTm4WpwgBtQqBsguym', 'david.peyrard@limayrac.fr', 'Peyrard', 'David', 1),
(12, 'ph', '$2y$10$50fd6ZGE.4gSJmwGCubcLeMzzx6e76j6AU5NzFWOtwF77HQCF.OC6', 'pierrehonore.akendengue@limayrac.fr', 'Akendengue', 'Pierre-Honoré', 0);

INSERT INTO ligue(`id_ligue`,`lib_ligue`)
VALUES
(1,"Ligue de Judo Auvergne-Rhone-Alpes"),
(2,"Ligue de football Haute-Garonne"),
(3,"Ligue de football d'Aquitaine"),
(4,"Ligue de tennis de Corse du Sud"),
(5,"Ligue d'equitation du VAR"),
(6,"Ligue de natation du Quercy");

INSERT INTO club(`id_club`,`lib_club`,`adr1`,`adr2`,`adr3`,`id_ligue`)
VALUES
(1,'Dojo Burgien','1 rue du Docteur DUBY','1000','BOURG EN BRESSE',1),
(2,'Saint-Denis Dojo','239 Allées des sports','1000','ST DENIS LES BOURG',1),
(3,'Judo Club Vallée Arbent','rue du Général ANDREA','1100','ARBENT',1),
(4,'Belli Judo','1 rue du Bac','1100','BELLIGNAT',1),
(5,'Racing Club Montluel Judo','170 rue des Chartinières','1120','DAGNEUX',1),
(6,'Centre Arts Martiaux Pondinois','rue de l Oiselon','1160','PONT D AIN',1),
(7,'Judo Club Ornex','58 rue des Pralets','1210','ORNEX',1),
(8,'Dojo Gessien Valserine','58 rue des Pralets','1220','DIVONNE LES BAINS',1),
(9,'Dojo La Vallière','Complexe Sportif','1250','MONTAGNAT',1),
(10,'Football club Merville','Rue Emile Pouvillon','31330','MERVILLE',2),
(11,'Football Club Bassin d Arcachon','Boulevard Mestrezat - Stade jean Brousse','33120','ARCACHON',3),
(12,'Andernos Sport Football Club','Plaine des Sports Jacques Rosazza','33510','ANDERNOS LES BAINS',3);

INSERT INTO `adherent` (`id_adherent`, `nr_licence`, `adr1`, `adr2`, `adr3`, `id_utilisateur`, `id_club`) VALUES
(1, '123', '1 rue du clone', '31000', 'toulouse', 9, 11),
(2, '012', '2 rue du clone', '31000', 'toulouse', 10, 5),
(3, '456', '3 rue du clone', '31000', 'toulouse', 11, 6),
(4, '789', '4 rue du clone', '31000', 'toulouse', 12, 12);

INSERT INTO motif(`id_motif`,`lib_motif`)
VALUES
(1, 'Réunion'),
(2, 'Compétition régionale'),
(3, 'Compétition nationale'),
(4, 'Compétition internationnale'),
(5, 'Stage'),
(6, 'Visite médicale'),
(7, 'Oxygénation'),
(8, 'Convocation'),
(9, 'Formation');

INSERT INTO periode(`lib_periode`,`est_active`,`mt_km`) 
VALUES
('2021','1','0.523'),
('2020','0','0.423'),
('2019','0','0.621'),
('2018','0','0.359'),
('2017','0','0.428'),
('2016','0','0.541'),
('2015','0','0.593');


INSERT INTO note(`est_valide`,`id_periode`,`id_utilisateur`)
VALUES
('0','1','12'),
('0','2','12'),
('0','3','12'),
('0','4','12'),
('0','5','12');

INSERT INTO ligne(`lib_trajet`,`nb_km`,`mt_peage`,`mt_repas`,`mt_hebergement`,`id_motif`,`id_note`)
VALUES
('Reu','50','15.00','16.00','45.00','1','2'),
('Comp','50','26.00','11.00','27.00','2','3'),
('Sta','100','19.00','19.00','53.00','5','2'),
('test','50','15.00','16.00','45.00','1','2'),
('test2','50','15.00','16.00','45.00','1','2');