/**
 * Script de génération d'un jeu de test pour la base de données
 * D. Rigaudière - octobre 2014
 */

/**
 * Table emprunteur
 */
INSERT INTO `location`.`emprunteur` (`idemprunteur`, `nom`, `prenom`)
    VALUES (1, 'Deray', 'Odile');
INSERT INTO `location`.`emprunteur` (`idemprunteur`, `nom`, `prenom`) 
    VALUES (2, 'Karamazov', 'Serge');
INSERT INTO `location`.`emprunteur` (`idemprunteur`, `nom`, `prenom`)
    VALUES (3, 'Jérémi', 'Simon');
INSERT INTO `location`.`emprunteur` (`idemprunteur`, `nom`, `prenom`) 
    VALUES (4, 'Bialès', 'Patrick');

/**
 * Table vehicule
 */
INSERT INTO `location`.`vehicule` (`idvehicule`, `immatriculation`, 
    `dateMiseCirculation`, `marque`, `modele`, `energie`, `releveKm`, 
    `prochaineRevisionKm`) 
    VALUES (1, 'AA-123-BB', '2014-01-10', 'Peugeot', '208', 'diesel', 2000, 10000);
INSERT INTO `location`.`vehicule` (`idvehicule`, `immatriculation`, 
    `dateMiseCirculation`, `marque`, `modele`, `energie`, `releveKm`, 
    `prochaineRevisionKm`) 
    VALUES (2, 'AA-456-CC', '2014-01-20', 'Peugeot', '308', 'diesel', 4000, 10000);
INSERT INTO `location`.`vehicule` (`idvehicule`, `immatriculation`, 
    `dateMiseCirculation`, `marque`, `modele`, `energie`, `releveKm`, 
    `prochaineRevisionKm`) 
    VALUES (3, 'AA-789-DD', '2014-02-01', 'Renault', 'Clio', 'essence', 1500, 10000);

/**
 * Table location
 */
INSERT INTO `location`.`location` (`idlocation`, `dateDebut`, `dateRetourPrevue`,
    `dateRetourReelle`, `releveKmDebut`, `releveKmFin`, `vehicule_idvehicule`, 
    `emprunteur_idemprunteur`) 
    VALUES (1, '2014-01-15', '2014-01-20', '2014-01-21', 0, 1500, 1, 1);
INSERT INTO `location`.`location` (`idlocation`, `dateDebut`, `dateRetourPrevue`,
    `dateRetourReelle`, `releveKmDebut`, `releveKmFin`, `vehicule_idvehicule`, 
    `emprunteur_idemprunteur`) 
    VALUES (2, '2014-01-25', '2014-01-30', '2014-01-30', 1500, 2000, 1, 2);
INSERT INTO `location`.`location` (`idlocation`, `dateDebut`, `dateRetourPrevue`,
    `dateRetourReelle`, `releveKmDebut`, `releveKmFin`, `vehicule_idvehicule`, 
    `emprunteur_idemprunteur`) 
    VALUES (3, '2014-01-22', '2014-01-30', '2014-01-30', 0, 2500, 1, 3);
INSERT INTO `location`.`location` (`idlocation`, `dateDebut`, `dateRetourPrevue`,
    `dateRetourReelle`, `releveKmDebut`, `releveKmFin`, `vehicule_idvehicule`, 
    `emprunteur_idemprunteur`) 
    VALUES (4, '2014-02-01', '2014-02-20', '2014-01-18', 2500, 4000, 1, 1);
INSERT INTO `location`.`location` (`idlocation`, `dateDebut`, `dateRetourPrevue`,
    `dateRetourReelle`, `releveKmDebut`, `releveKmFin`, `vehicule_idvehicule`, 
    `emprunteur_idemprunteur`) 
    VALUES (5, '2014-02-10', '2014-02-25', '2014-02-25', 0, 1500, 1, 4);

/**
 * Table etatLieux
 */
INSERT INTO `location`.`etatLieux` (`idetatLieux`, `moment`, `description`, `photo`,
    `urgenceEntretien`, `location_idlocation`) 
    VALUES (1, 'avant', 'Voiture neuve', NULL, false, 1);
INSERT INTO `location`.`etatLieux` (`idetatLieux`, `moment`, `description`, `photo`,
    `urgenceEntretien`, `location_idlocation`) 
    VALUES (2, 'après', 'RAS', NULL, false, 1);
INSERT INTO `location`.`etatLieux` (`idetatLieux`, `moment`, `description`, `photo`,
    `urgenceEntretien`, `location_idlocation`) 
    VALUES (3, 'avant', 'RAS', NULL, false, 2);
INSERT INTO `location`.`etatLieux` (`idetatLieux`, `moment`, `description`, `photo`,
    `urgenceEntretien`, `location_idlocation`) 
    VALUES (4, 'après', 'Rayure porte gauche', NULL, false, 2);
INSERT INTO `location`.`etatLieux` (`idetatLieux`, `moment`, `description`, `photo`,
    `urgenceEntretien`, `location_idlocation`) 
    VALUES (5, 'avant', 'Voiture neuve', NULL, false, 3);
INSERT INTO `location`.`etatLieux` (`idetatLieux`, `moment`, `description`, `photo`,
    `urgenceEntretien`, `location_idlocation`) 
    VALUES (6, 'après', 'RAS', NULL, false, 3);
INSERT INTO `location`.`etatLieux` (`idetatLieux`, `moment`, `description`, `photo`,
    `urgenceEntretien`, `location_idlocation`) 
    VALUES (7, 'avant', 'RAS', NULL, false, 4);
INSERT INTO `location`.`etatLieux` (`idetatLieux`, `moment`, `description`, `photo`,
    `urgenceEntretien`, `location_idlocation`) 
    VALUES (8, 'après', 'RAS', NULL, false, 4);
INSERT INTO `location`.`etatLieux` (`idetatLieux`, `moment`, `description`, `photo`,
    `urgenceEntretien`, `location_idlocation`) 
    VALUES (9, 'avant', 'Voiture neuve', NULL, false, 5);
INSERT INTO `location`.`etatLieux` (`idetatLieux`, `moment`, `description`, `photo`,
    `urgenceEntretien`, `location_idlocation`) 
    VALUES (10, 'après', 'Ampoule phare HS', NULL, false, 5);


/**
 * Table entretien
 */
INSERT INTO `location`.`entretien` (`identretien`, `date`, `releveKm`, `description`,
    `vehicule_idvehicule`) 
    VALUES (1, '2014-02-26', 1500, 'Changement ampoule', 3);


