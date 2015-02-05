/**
 * Table CompagnieAssurance
 */
INSERT INTO `location`.`compagnieassurance` (`idCompagnie`, `descripCompagnie`) 
    VALUES (1,'GROUPAMA');
INSERT INTO `location`.`compagnieassurance` (`idCompagnie`, `descripCompagnie`) 
    VALUES (2,'MAIF');
INSERT INTO `location`.`compagnieassurance` (`idCompagnie`, `descripCompagnie`) 
    VALUES (3,'MACIF');

/**
 * Table Contrat
 */
INSERT INTO `location`.`contrat` (`idVehicule`, `idCompagnie`, `annee`) 
    VALUES (1, 1,'2014');
INSERT INTO `location`.`contrat` (`idVehicule`, `idCompagnie`, `annee`)
    VALUES (2, 1, '2015');
INSERT INTO `location`.`contrat` (`idVehicule`, `idCompagnie`, `annee`) 
    VALUES (3, 2, '2013');