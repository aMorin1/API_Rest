/**
 * Script de génération des tables sous MySQL
 * D. Rigaudière - octobre 2014
 */

/**
 * Création du schéma de la base location
 * encodé en utf8
 */
CREATE SCHEMA IF NOT EXISTS `location` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

/**
 * Création de la table utilisateurs
 * qui contient les accès à l'application :
 * login, password, salt (le password est haché en SHA256 avec un salt de 64 caractères)
 * le rôle de l'utilisateur est soit admin soit editor
 * et on stockera les infos sur le moment de la dernière connexion réussie et échouée
 * ainsi que le nombre de tentatives échouées
 */
CREATE TABLE IF NOT EXISTS `location`.`utilisateur` (
  `idutilisateur` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `hashPassword` VARCHAR(45) NOT NULL,
  `salt` CHAR(64) NOT NULL,
  `role` ENUM('admin','editor') NOT NULL,
  `derniereConnexion` TIMESTAMP NULL,
  `dernierEchecConnexion` TIMESTAMP NULL,
  `nombreEchecConnexion` INT NULL,
  PRIMARY KEY (`idutilisateur`))
ENGINE = InnoDB;

/**
 * Insertion de l'utilisateur administrateur
 */
INSERT INTO `location`.`utilisateur` (
  `idutilisateur`, `login`, `hashPassword`, `salt`,
  `role`, `derniereConnexion`, `dernierEchecConnexion`, `nombreEchecConnexion`)
  VALUES (NULL, 'admin', '2c624232cdd221771294dfbb310aca000a0df6ac8b66b696d90ef06fdefb64a3', '8def3bf5d78abb247b4829e87b52b10d79b1cd0e2aec529930ed692ee8d1cd2c',
  'admin', NULL, NULL, 0);

/**
 * Création de la table vehicule
 * qui contient les données sur les véhicules mis à disposition
 * marque, modèle, immatriculation, nombre de kilomètres après la dernière location
 * et kilométrage prévu pour la prochaine révision
 */
CREATE TABLE IF NOT EXISTS `location`.`vehicule` (
  `idvehicule` INT NOT NULL AUTO_INCREMENT,
  `immatriculation` CHAR(9) NOT NULL,
  `dateMiseCirculation` DATE NULL,
  `marque` VARCHAR(45) NULL,
  `modele` VARCHAR(45) NULL,
  `energie` ENUM('essence','diesel','électrique') NULL,
  `releveKm` INT NULL,
  `prochaineRevisionKm` INT NULL,
  PRIMARY KEY (`idvehicule`),
  UNIQUE INDEX `immatriculation_UNIQUE` (`immatriculation` ASC))
ENGINE = InnoDB;

/**
 * Création de la table emprunteur
 * qui contient les données salariés (nom et prénom)
 * qui ont emprunté un véhicule
 */
CREATE TABLE IF NOT EXISTS `location`.`emprunteur` (
  `idemprunteur` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL,
  `prenom` VARCHAR(45) NULL,
  PRIMARY KEY (`idemprunteur`))
ENGINE = InnoDB;

/**
 * Création de la table location
 * qui contient les données sur les locations
 * lien avec un véhicule et un emprunteur
 * dates de location et kilométrages
 */
CREATE TABLE IF NOT EXISTS `location`.`location` (
  `idlocation` INT NOT NULL AUTO_INCREMENT,
  `dateDebut` DATETIME NULL,
  `dateRetourPrevue` DATETIME NULL,
  `dateRetourReelle` DATETIME NULL,
  `releveKmDebut` INT NULL,
  `releveKmFin` INT NULL,
  `vehicule_idvehicule` INT NOT NULL,
  `emprunteur_idemprunteur` INT NOT NULL,
  PRIMARY KEY (`idlocation`),
  INDEX `fk_location_vehicule_idx` (`vehicule_idvehicule` ASC),
  INDEX `fk_location_emprunteur1_idx` (`emprunteur_idemprunteur` ASC),
  CONSTRAINT `fk_location_vehicule`
    FOREIGN KEY (`vehicule_idvehicule`)
    REFERENCES `location`.`vehicule` (`idvehicule`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_location_emprunteur1`
    FOREIGN KEY (`emprunteur_idemprunteur`)
    REFERENCES `location`.`emprunteur` (`idemprunteur`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

/**
 * Création de la table etatLieux
 * qui contient les données sur les états des lieux réalisés avant
 * et après une location
 * (problèmes rencontrés assortis éventuellement d'une photo)
 */
CREATE TABLE IF NOT EXISTS `location`.`etatLieux` (
  `idetatLieux` INT NOT NULL AUTO_INCREMENT,
  `moment` ENUM('avant','après') NULL,
  `description` VARCHAR(255) NULL,
  `photo` LONGBLOB NULL,
  `urgenceEntretien` TINYINT(1) NULL,
  `location_idlocation` INT NOT NULL,
  PRIMARY KEY (`idetatLieux`),
  INDEX `fk_etatLieux_location1_idx` (`location_idlocation` ASC),
  CONSTRAINT `fk_etatLieux_location1`
    FOREIGN KEY (`location_idlocation`)
    REFERENCES `location`.`location` (`idlocation`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

/**
 * Création de la table entretien
 * qui contient les données sur les révisions d'un véhicule
 * lien avec un véhicule
 * description et date de l'entretien réalisé ainsi que du kilométrage
 * du véhicule
 */
CREATE TABLE IF NOT EXISTS `location`.`entretien` (
  `identretien` INT NOT NULL AUTO_INCREMENT,
  `date` DATE NULL,
  `releveKm` INT NULL,
  `description` VARCHAR(65535) NULL,
  `vehicule_idvehicule` INT NOT NULL,
  PRIMARY KEY (`identretien`),
  INDEX `fk_entretien_vehicule1_idx` (`vehicule_idvehicule` ASC),
  CONSTRAINT `fk_entretien_vehicule1`
    FOREIGN KEY (`vehicule_idvehicule`)
    REFERENCES `location`.`vehicule` (`idvehicule`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;
