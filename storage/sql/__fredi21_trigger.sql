USE fredi21;
DELIMITER |
CREATE OR REPLACE TRIGGER before_update_ligne BEFORE UPDATE
ON ligne FOR EACH ROW
BEGIN

    DECLARE mt_periode FLOAT;
    
    SELECT mt_km INTO mt_periode FROM periode WHERE est_active=1 LIMIT 1;
    SET NEW.mt_km = NEW.nb_km * mt_periode;

    SET NEW.mt_total = NEW.mt_repas + NEW.mt_peage + NEW.mt_hebergement+NEW.mt_km;
    
END|

DELIMITER |
CREATE OR REPLACE TRIGGER before_insert_ligne BEFORE INSERT
ON ligne FOR EACH ROW
BEGIN
    DECLARE mt_periode FLOAT;
    
    SELECT mt_km INTO mt_periode FROM periode WHERE est_active=1 LIMIT 1;
    SET NEW.mt_km = NEW.nb_km * mt_periode;

    SET NEW.mt_total = NEW.mt_repas + NEW.mt_peage + NEW.mt_hebergement+NEW.mt_km;
END|

DELIMITER |
CREATE OR REPLACE TRIGGER after_update_ligne AFTER UPDATE
ON ligne FOR EACH ROW
BEGIN
    DECLARE mt_total_ligne FLOAT;
	SELECT SUM(ligne.mt_total) INTO mt_total_ligne FROM ligne, note WHERE ligne.id_note = NEW.id_note AND note.id_note = ligne.id_note;
    UPDATE note SET mt_total = mt_total_ligne WHERE note.id_note = NEW.id_note;
END|


DELIMITER |
CREATE OR REPLACE TRIGGER after_insert_ligne AFTER INSERT
ON ligne FOR EACH ROW
BEGIN
    DECLARE mt_total_ligne FLOAT;
	SELECT SUM(ligne.mt_total) INTO mt_total_ligne FROM ligne, note WHERE ligne.id_note = NEW.id_note AND note.id_note = ligne.id_note;
    UPDATE note SET mt_total = mt_total_ligne WHERE note.id_note = NEW.id_note;
END|
