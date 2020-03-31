BEGIN TRANSACTION;
CREATE TABLE "inscriptions" (
    `InscriptionId` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    `JourArrivee` NVARCHAR(9),
    `NombreNuit` INTEGER,
    `NombrePetitDejeuner` INTEGER,
    `NombreDejeuner` INTEGER,
    `NombreDiner` INTEGER,
    `Pseudo` NVARCHAR(80) UNIQUE,
    `Prenom` NVARCHAR(40), 
    `Nom` NVARCHAR(40), 
    `EmailSpecial` VARCHAR(120) UNIQUE,
    `Email` VARCHAR(120) UNIQUE,
    `Rue` VARCHAR(120),
    `NumeroBoite` NVARCHAR(10),
    `ComplementAdresse` VARCHAR(120),
    `Ville` NVARCHAR(40), 
    `Pays` NVARCHAR(40), 
    `CodePostal` NVARCHAR(10), 
    `NomAssociation` NVARCHAR(20),
    `Allergies` VARCHAR(200),
    `Commentaire` TEXT);
COMMIT; 

BEGIN TRANSACTION;
CREATE TABLE "deuxmots" (
    `DeuxMotsID` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`DeuxMots` TEXT,
    `JourArrivee` TEXT,
    `NombreNuit` INTEGER default 0,
	`NombrePetitDejeuner` INTEGER default 0,
    `NombreDejeuner` INTEGER default 0,
    `NombreDiner` INTEGER default 0,
    `Allergies` TEXT default "sans",
    `Handicap` TEXT default "sans",
    `Autre` TEXT,
	`PayeParDeuxMots` TEXT,
	`PayeCash` INTEGER default 0,
	`PayeVirementAvant` INTEGER default 0,
	`PayeVirementApres` INTEGER default 0,
	`FaitDon` NUMERIC,
	`PafProblem` INTEGER default 0,
	`MontantEspere` NUMERIC,
	`MontantRecu` NUMERIC,
	`CommentaireNeutrinet` TEXT);
COMMIT;
