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