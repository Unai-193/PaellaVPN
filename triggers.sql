CREATE DATABASE geografia;

create table distancia (
ciutat1 varchar(20);
ciutat2 varchar(20);
km double unsigned;
milles double unsigned;
);

USE geografia;
DROP TRIGGER IF EXISTS before_insert_distancia;
DELIMITER //

CREATE TRIGGER before_insert_distancia BEFORE INSERT ON distancia
  FOR EACH ROW
    BEGIN
      Declare kmi, mik double;
      SET kmi = 0.621371;
      SET mik = 1.609344;
      IF NEW.km > 0 THEN
        SET NEW.milles = NEW.km * kmi;
        ELSEIF NEW.milles > 0 THEN
          SET NEW.km = NEW.milles * mik;
      END IF;
      END //
DELIMETER ;

DELIMITER //

CREATE TRIGGER before_update_distancia BEFORE UPDATE ON distancia
  FOR EACH ROW
    BEGIN
      Declare kmi, mik double;
      SET kmi = 0.621371;
      SET mik = 1.609344;
      IF NEW.km <> OLD.km AND NEW.km > 0 THEN
        SET NEW.milles = NEW.km * kmi;
        ELSEIF NEW.milles <> OLD.milles AND NEW.milles > 0 THEN
          SET NEW.km = NEW.milles * mik;
        ELSEIF NEW.KM = 0 OR NEW.milles = 0 THEN
           SET NEW.km = 0, NEW.milles = 0;
      END IF;
      END //
DELIMETER ;

/*  
-- VER LOS TRIGGERS ACTUALES
SELECT trigger_name, trigger_schema FROM information_schema.triggers where trigger_schema=database();


*/

