INSERT into Users VALUES
	(1, "compte_invite", "mdpinvite"),
	(1, "compte_admin", "mdpadmin");

INSERT into Semestre VALUES
	(1, "S1"),
	(2, "S2"),
	(3, "S3"),
	(4, "S4"),
	(5, "S5"),
	(6, "S6");

INSERT into Competence VALUES
	(1, "BIN11", 1),
	(2, "BIN12", 1),
	(3, "BIN13", 1),
	(4, "BIN14", 1),
	(5, "BIN15", 1),
	(6, "BIN16", 1),
	(7, "BIN21", 2),
	(8, "BIN22", 2),
	(9, "BIN23", 2),
	(10, "BIN24", 2),
	(11, "BIN25", 2),
	(12, "BIN26", 2);

INSERT into Bin VALUES
	(1, "BINR101", 1, 1),
	(2, "BINR102", 2, 1),
	(3, "BINR112", 3, 1),
	(4, "BINR204", 4, 2),
	(5, "BINR307", 5, 3),
	(6, "BINR406", 6, 4),
	(7, "BINR206", 7, 2),
	(8, "BINR106", 8, 1),
	(9, "BINS411", 9, 4),
	(10, "BINS411", 10, 4),
	(11, "BINS401", 11, 4),
	(12, "BINP401", 12, 4);

INSERT into Etudiant (etu_id, codenip, civ, nom, prenom, grpTD, grpTP, cursus, bac, passage, decision) VALUES 
	(8860, 8860, "M.", "ROCHE", "Pierre", "A", "A1", "S1 S2 S3 S4 S5 S6", "NBGE", "S2", "ADM"),
	(8810, 8810, "Mme.", "DELAFORET", "Sylvie", "D", "D2", "S1 S2 S3 S4", "NBGE", "S2", "ADM"),
	(8918, 8918, "M.", "PASLAREF", "Jean-Pierre", "D", "D1", "S1 S2 S3 S4 S5 S6", "STI2D", "S2", "ADM"),
	(8811, 8811, "Mme.", "FONTAINE", "Ondine", "B", "B2", "S1 S2 S3 S4", "NBGE", "S2", "ADM");

INSERT into Etudiant (etu_id, codenip, rang, civ, nom, prenom, grpTD, grpTP, cursus, bac, specialite, passage, decision) VALUES
	(8884, 8884, "Mme.", "PASDECEINTURE", "Jean-Michel", "B", "B2", "S1 S2 S1", "S", "SCIENCES","S2", "ADM"),
	(8874, 8874, "Mme.", "AFEE", "Mack", "B", "B2", "S1 S2", "S", "SCIENCES","S2", "ADM");

INSERT into moyene_competence VALUES
	(8860, 8860, 1, 14.65, 0.16),
	(8860, 8860, 2, 17.05),
	(8860, 8860, 3, 17.23),
	(8860, 8860, 4, 18.23),
	(8810, 8810, 4, 15.54),
	(8810, 8810, 6, 11.74);
		
INSERT into moyenne_eleve VALUES
	(8860, 8860, 1, 16.28),
	(8810, 8810, 1, 17.41);

INSERT into validation VALUES
	(8860,8860, 1, 6, "ADM", 16.03, 3, 0),
	(8811,8811, 1, 6, "ADM", 14.69, 2, 0);