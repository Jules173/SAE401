DROP TABLE Users             cascade;
DROP TABLE Validation        cascade;
DROP TABLE Attribution       cascade;
DROP TABLE MoyenneCompetence cascade;
DROP TABLE Competence        cascade;
DROP TABLE Semestre          cascade;
DROP TABLE MoyenneEleve      cascade;
DROP TABLE Bin               cascade;
DROP TABLE Administration    cascade;
DROP TABLE Etudiant          cascade;




CREATE TABLE Etudiant (
	idEtu      serial PRIMARY KEY,
	codenip    int unique,
	civ        varchar(4),
	nom        varchar(50),
	prenom     varchar(50),
	grpTD      char,
	grpTP      varchar(2),
	bac        varchar(50),
	specialite varchar(50)
);



CREATE TABLE Administration (
	idAdmin                 serial PRIMARY KEY,
	absence                 int NOT NULL default 0,
	nombreAbsenceJustifiees int NOT NULL default 0,
	statut                  varchar(20)  default 'initial',
	annee                   int NOT NULL,
	idEtu                   int NOT NULL,

	FOREIGN KEY(idEtu) REFERENCES Etudiant(idEtu)
);



CREATE TABLE Bin (
	idBin   serial PRIMARY KEY,
	nomBin  varchar(20),
	codeBin varchar(7)
);



CREATE TABLE MoyenneEleve (
	idEtu   int NOT NULL,
	idBin   int NOT NULL,
	moyenne float,
	annee   int NOT NULL,

	PRIMARY KEY( idEtu, idBin ),
	FOREIGN KEY (idEtu) REFERENCES Etudiant(idEtu),
	FOREIGN KEY (idBin) REFERENCES Bin     (idBin)
);



CREATE TABLE Semestre (
	idSemestre serial PRIMARY KEY,
	semestre   int NOT NULL,
	annee      int NOT NULL
);



CREATE TABLE Competence (
	idComp     serial PRIMARY KEY,
	nom        varchar(30),
	code       varchar(6),
	idSemestre int NOT NULL,

	FOREIGN KEY (idSemestre) REFERENCES Semestre (idSemestre)
);



CREATE TABLE MoyenneCompetence (
	idComp    int NOT NULL,
	idEtu     int NOT NULL,
	bonus     float      DEFAULT 0,
	decision  varchar(3) DEFAULT 'ADM',

	PRIMARY KEY (idComp, idEtu),
	FOREIGN KEY (idComp) REFERENCES Competence (idComp),
	FOREIGN KEY (idEtu)  REFERENCES Etudiant   (idEtu)
);



CREATE TABLE Attribution (
	idComp int NOT NULL,
	idBin  int NOT NULL,
	coeff  int NOT NULL,

	PRIMARY KEY (idComp, idBin),
	FOREIGN KEY (idComp) REFERENCES Competence (idComp),
	FOREIGN KEY (idBin)  REFERENCES Bin        (idBin )
);



CREATE TABLE Validation (
	idEtu      int NOT NULL,
	idSemestre int NOT NULL,
	decision   varchar(3) default 'ADM',
	motif      varchar(50),
	typeAdm    varchar(50),
	annee      int NOT NULL,

	PRIMARY KEY (idEtu, idSemestre),
	FOREIGN KEY (idEtu)      REFERENCES Etudiant (idEtu),
	FOREIGN KEY (idSemestre) REFERENCES Semestre (idSemestre)
);



CREATE TABLE Users(
	idUsr  serial PRIMARY KEY,
	nom    varchar(90) NOT NULL,
	mdp    varchar(90) NOT NULL,
	admin  boolean DEFAULT FALSE
);
