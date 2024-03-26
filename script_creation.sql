CREATE TABLE Etudiant(
   etu_id INT,
   codenip INT NOT NULL UNIQUE,
   rang SERIAL NOT NULL,
   civ VARCHAR(4) NOT NULL,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   grpTD VARCHAR(1) NOT NULL,
   grpTP VARCHAR(2) NOT NULL,
   cursus VARCHAR(50) NOT NULL,
   bac VARCHAR(50) NOT NULL,
   specialite VARCHAR(50),
   passage VARCHAR(50) NOT NULL,
   decision VARCHAR(50),
   motif VARCHAR(50) DEFAULT 'modifier décisions',
   type_adm VARCHAR(50),
   rang_adm VARCHAR(50),
   PRIMARY KEY(etu_id) 
);

CREATE TABLE Semestre(
   id_semestre INT,
   nom_semestre VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_semestre)
);

CREATE TABLE Users(
   id_compte INT,
   username VARCHAR(50) NOT NULL,
   mdp VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_compte)
);

CREATE TABLE Competence(
   id_competence VARCHAR(50),
   nom_comp VARCHAR(50) NOT NULL,
   id_semestre INT NOT NULL,
   PRIMARY KEY(id_competence),
   FOREIGN KEY(id_semestre) REFERENCES Semestre(id_semestre)(8860, 8860, 1, 14.65, ),
);

CREATE TABLE Bin(
   id_bin INT,
   nom_bin VARCHAR(50),
   id_competence INT
   id_semestre VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_bin),
   FOREIGN KEY(id_semestre) REFERENCES Semestre(id_semestre),
   FOREIGN KEY(id_competence) REFERENCES Competence(id_competence)
);

CREATE TABLE moyene_competence(
   etu_id INT,
   codenip INT,
   id_competence INT,
   moyenne DECIMAL(4,2) NOT NULL,
   PRIMARY KEY(etu_id, codenip, id_competence),
   FOREIGN KEY(etu_id, codenip) REFERENCES Etudiant(etu_id, codenip),
   FOREIGN KEY(id_competence) REFERENCES Competence(id_competence)
);

CREATE TABLE moyenne_eleve(
   etu_id INT,
   codenip INT,
   id_competence INT,
   moyenne DECIMAL(4,2) NOT NULL,
   bonus DECIMAL(4,2) NOT NULL DEFAULT 0,
   PRIMARY KEY(etu_id, codenip, id_bin),
   FOREIGN KEY(etu_id, codenip) REFERENCES Etudiant(etu_id, codenip),
   FOREIGN KEY(id_bin) REFERENCES Bin(id_bin)
);

CREATE TABLE validation(
   etu_id INT,
   codenip INT,
   id_semestre INT,
   uevalide VARCHAR(50) NOT NULL,
   decision VARCHAR(50),
   moyenne DECIMAL(4,2) NOT NULL,
   absence INT NOT NULL DEFAULT 0,
   nb_justif_absence INT NOT NULL DEFAULT 0,
   PRIMARY KEY(etu_id, codenip, id_semestre),
   FOREIGN KEY(etu_id, codenip) REFERENCES Etudiant(etu_id, codenip),
   FOREIGN KEY(id_semestre) REFERENCES Semestre(id_semestre)
);
