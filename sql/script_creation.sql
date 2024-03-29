CREATE TABLE Etudiant(
   etu_id INT,
   codenip INT NOT NULL,
   civ VARCHAR(4) NOT NULL,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   grpTD VARCHAR(1) NOT NULL,
   grpTP VARCHAR(2) NOT NULL,
   bac VARCHAR(50) NOT NULL,
   specialite VARCHAR(50),
   PRIMARY KEY(etu_id),
   UNIQUE(codenip)
);

CREATE TABLE Bin(
   id_bin INT,
   nom_bin VARCHAR(50),
   PRIMARY KEY(id_bin)
);

CREATE TABLE Semestre(
   id_semestre INT,
   semestre VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_semestre)
);

CREATE TABLE Users(
   id_compte INT,
   username VARCHAR(50) NOT NULL,
   mdp VARCHAR(50) NOT NULL,
   admin LOGICAL NOT NULL DEFAULT FALSE,
   PRIMARY KEY(id_compte)
);

CREATE TABLE Administration(
   id_administration VARCHAR(50),
   absence INT NOT NULL DEFAULT 0,
   nb_justif_absence INT NOT NULL DEFAULT 0,
   annee VARCHAR(50) NOT NULL,
   etu_id INT NOT NULL,
   PRIMARY KEY(id_administration),
   FOREIGN KEY(etu_id) REFERENCES Etudiant(etu_id)
);

CREATE TABLE Competence(
   id_competence INT,
   nom_comp VARCHAR(50) NOT NULL,
   id_semestre INT NOT NULL,
   PRIMARY KEY(id_competence),
   FOREIGN KEY(id_semestre) REFERENCES Semestre(id_semestre)
);

CREATE TABLE moyenne_competence(
   etu_id INT,
   id_competence INT,
   bonus DECIMAL(4,2) NOT NULL DEFAULT 0,
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
   moyenne DECIMAL(4,2) NOT NULL,
   PRIMARY KEY(etu_id, id_bin),
   FOREIGN KEY(etu_id) REFERENCES Etudiant(etu_id),
   FOREIGN KEY(id_bin) REFERENCES Bin(id_bin)
);

CREATE TABLE Promotion(
   etu_id INT,
   id_semestre INT,
   nom_status VARCHAR(50) NOT NULL DEFAULT 'Initial',
   annee VARCHAR(50) NOT NULL,
   PRIMARY KEY(etu_id, id_semestre),
   FOREIGN KEY(etu_id) REFERENCES Etudiant(etu_id),
   FOREIGN KEY(id_semestre) REFERENCES Semestre(id_semestre)
);
