-- Instructions INSERT pour la table Users
INSERT INTO Users (nom, mdp, admin) VALUES
	('toto', '$2y$10$Bt1fPpRPq7MEr/o3.i4Gv.ZkFUKhQyxKSpb6wXK6rdif5aUrlyFKS', FALSE),
	('admin', '$2y$10$GA2VY4335So2bWRmsTMBtOe8QPhh4vU/tSzemcxKqvwmypEd7dDV.', TRUE);

-- Instructions INSERT pour la table Etudiant
INSERT INTO Etudiant (idEtu,codenip, civ, nom, prenom, grpTD, grpTP, bac) VALUES
	(8860, 8860, 'Mme.', 'GAROU', 'Lou', 'A', 'A1', 'NBGE'),
	(8810, 8810, 'M.', 'PASDECEINTURE', 'Jean-Michel', 'B', 'B1', 'NBGE'),
	(8918, 8918, 'Mme.', 'DELAFORET', 'Sylvie', 'B', 'B2', 'NBGE'),
	(8811, 8811, 'M.', 'ABBE', 'Cedric', 'C', 'C1', 'NBGE');

-- Instructions INSERT pour la table Bin
INSERT INTO Bin (nomBin, codeBin) VALUES
	('BINR101', 'BINR101'),
	('BINR102', 'BINR102'),
	('BINR103', 'BINR103'),
	('BINR104', 'BINR104'),
	('BINR105', 'BINR105'),
	('BINR106', 'BINR106'),
	('BINR107', 'BINR107'),
	('BINR108', 'BINR108'),
	('BINR109', 'BINR109'),
	('BINR110', 'BINR110'),
	('BINR111', 'BINR111'),
	('BINS101', 'BINS101'),
	('BINS102', 'BINS102'),
	('BINS103', 'BINS103'),
	('BINS104', 'BINS104'),
	('BINS105', 'BINS105'),
	('BINS106', 'BINS106');

-- Instructions INSERT pour la table Semestre
INSERT INTO Semestre (semestre, annee) VALUES
	(1, 2023),
	(2, 2023),
	(3, 2023),
	(4, 2023),
	(5, 2023),
	(6, 2023);

-- Instructions INSERT pour la table Competence
INSERT INTO Competence (nom, code, idSemestre) VALUES
	('BIN11', 'BIN11', 1),
	('BIN12', 'BIN12', 1),
	('BIN13', 'BIN13', 1),
	('BIN14', 'BIN14', 1),
	('BIN15', 'BIN15', 1),
	('BIN16', 'BIN16', 1);

-- Instructions INSERT pour la table MoyenneCompetence
INSERT INTO MoyenneCompetence (idComp, idEtu, bonus, decision) VALUES
	(1, 8860, 0.16, 'ADM'),
	(1, 8918, 0.32, 'ADM'),
	(1, 8810, 0, 'ADM'),
	(1, 8811, 0, 'ADM');

-- Instructions INSERT pour la table Validation
INSERT INTO Validation (idEtu, idSemestre, decision, annee) VALUES
	(8860, 1, 'ADM', 2023),
	(8810, 1, 'ADM', 2023),
	(8918, 1, 'ADM', 2023),
	(8811, 1, 'ADM', 2023);

-- Instructions INSERT pour la table Attribution
INSERT INTO Attribution (idComp, idBin, coeff) VALUES
	(1, 1, 46),
	(1, 2, 8),
	(1, 10, 6),
	(2, 1, 30),
	(2, 6, 10),
	(2, 7, 20),
	(3, 3, 20),
	(3, 4, 20),
	(3, 10, 12),
	(3, 8, 8),
	(4, 5, 36),
	(4, 6, 18),
	(4, 9, 6),
	(5, 1, 5),
	(5, 2, 13),
	(5, 5, 4),
	(5, 8, 23),
	(5, 11, 15),
	(6, 1, 4),
	(6, 2, 5),
	(6, 8, 9),
	(6, 9, 12),
	(6, 10, 12),
	(6, 11, 12),
	(6, 12, 6);

-- Instructions INSERT pour la table MoyenneEleve
INSERT INTO MoyenneEleve (idEtu, idBin, moyenne, annee) VALUES
	(8860, 1, 16.28, 2023),
	(8810, 1, 17.41, 2023),
	(8918, 1, 18.74, 2023),
	(8811, 1, 18.85, 2023),
	(8860, 2, 16.20, 2023),
	(8810, 2, 17.87, 2023),
	(8918, 2, 19.12, 2023),
	(8811, 2, 17.18, 2023);

INSERT INTO Administration (absence, nombreAbsenceJustifiees, statut, annee, idEtu) VALUES
    (3, 0, 'initial', 2023, 8860),
    (2, 1, 'initial', 2023, 8810),
    (3, 0, 'initial', 2023, 8918),
    (2, 0, 'initial', 2023, 8811);