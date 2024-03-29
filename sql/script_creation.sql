DROP TABLE IF EXISTS Etudiant CASCADE;
DROP TABLE IF EXISTS Bin CASCADE;
DROP TABLE IF EXISTS Semestre CASCADE;
DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS Administation CASCADE;
DROP TABLE IF EXISTS Competence CASCADE;
DROP TABLE IF EXISTS moyenne_competence CASCADE;
DROP TABLE IF EXISTS validation CASCADE;
DROP TABLE IF EXISTS Attribution CASCADE;
DROP TABLE IF EXISTS moyenne_eleve CASCADE;
DROP TABLE IF EXISTS Promotion CASCADE;

CREATE TABLE Etudiant(
   etu_id INT,
   codenip INT,
   civ VARCHAR(4),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   grpTD VARCHAR(1),
   grpTP VARCHAR(2),
   bac VARCHAR(50),
   specialite VARCHAR(50),
   PRIMARY KEY(etu_id),
   UNIQUE(codenip)
);

CREATE TABLE Bin(
   id_bin SERIAL,
   nom_bin VARCHAR(50),
   PRIMARY KEY(id_bin)
);

CREATE TABLE Semestre(
   id_semestre SERIAL,
   semestre VARCHAR(50),
   PRIMARY KEY(id_semestre)
);

CREATE TABLE Users(
   id_compte SERIAL,
   username VARCHAR(50),
   mdp VARCHAR(50),
   admin LOGICAL DEFAULT FALSE,
   PRIMARY KEY(id_compte)
);

CREATE TABLE Administration(
   id_administration VARCHAR(50),
   absence INT DEFAULT 0,
   nb_justif_absence INT DEFAULT 0,
   annee VARCHAR(50),
   etu_id INT,
   PRIMARY KEY(id_administration),
   FOREIGN KEY(etu_id) REFERENCES Etudiant(etu_id)
);

CREATE TABLE Competence(
   id_competence SERIAL,
   nom_comp VARCHAR(50),
   id_semestre INT,
   PRIMARY KEY(id_competence),
   FOREIGN KEY(id_semestre) REFERENCES Semestre(id_semestre)
);

CREATE TABLE moyenne_competence(
   etu_id INT,
   id_competence INT,
   bonus DECIMAL(4,2) DEFAULT 0,
   decision VARCHAR(50) DEFAULT 'ADM',
   PRIMARY KEY(etu_id, id_competence),
   FOREIGN KEY(etu_id) REFERENCES Etudiant(etu_id),
   FOREIGN KEY(id_competence) REFERENCES Competence(id_competence)
);

CREATE TABLE validation(
   etu_id INT,
   id_semestre INT,
   decision VARCHAR(50) DEFAULT 'ADM',
   passage VARCHAR(50),
   motif VARCHAR(50) DEFAULT 'Modifier decision',
   type_adm VARCHAR(50),
   rang_adm VARCHAR(50),
   PRIMARY KEY(etu_id, id_semestre),
   FOREIGN KEY(etu_id) REFERENCES Etudiant(etu_id),
   FOREIGN KEY(id_semestre) REFERENCES Semestre(id_semestre)
);

CREATE TABLE Attribution(
   id_competence INT,
   id_bin INT,
   coeff INT,
   PRIMARY KEY(id_competence, id_bin),
   FOREIGN KEY(id_competence) REFERENCES Competence(id_competence),
   FOREIGN KEY(id_bin) REFERENCES Bin(id_bin)
);

CREATE TABLE moyenne_eleve(
   etu_id INT,
   id_bin INT,
   moyenne DECIMAL(4,2),
   PRIMARY KEY(etu_id, id_bin),
   FOREIGN KEY(etu_id) REFERENCES Etudiant(etu_id),
   FOREIGN KEY(id_bin) REFERENCES Bin(id_bin)
);

CREATE TABLE Promotion(
   etu_id INT,
   id_semestre INT,
   nom_status VARCHAR(50) DEFAULT 'Initial',
   annee VARCHAR(50),
   PRIMARY KEY(etu_id, id_semestre),
   FOREIGN KEY(etu_id) REFERENCES Etudiant(etu_id),
   FOREIGN KEY(id_semestre) REFERENCES Semestre(id_semestre)
);
