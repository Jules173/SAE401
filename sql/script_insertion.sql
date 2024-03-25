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
	(1, "C1", 1),
	(2, "C2", 1),
	(3, "C3", 1),
	(4, "C4", 1),
	(5, "C5", 1),
	(6, "C6", 1),
	(7, "C1", 2),
	(8, "C2", 2),
	(9, "C3", 2),
	(10, "C4", 2),
	(11, "C5", 2),
	(12, "C6", 2);

INSERT into Bin VALUES
	(1, "BIN11BIN21", 1),
	(2, "BIN12BIN22", 1),
	(3, "BIN13BIN23", 1),
	(4, "BIN14BIN24", 1),
	(5, "BIN15BIN25", 1),
	(6, "BIN16BIN26", 1),
	(7, "BIN11", 1),
	(8, "BIN12", 1),
	(9, "BIN13", 1),
	(10, "BIN14", 1),
	(11, "BIN15", 1),
	(12, "BIN16", 1);

INSERT into Etudiant (etu_id, codenip, civ, nom, prenom, grpTD, grpTP, cursus, bac, passage, decision) VALUES 
	(8860, 8860, "M.", "ROCHE", "Pierre", "A", "A1", "S1 S2 S3 S4 S5 S6", "NBGE", "S2", "ADM"),
	(8810, 8810, "Mme.", "DELAFORET", "Sylvie", "D", "D2", "S1 S2 S3 S4", "NBGE", "S2", "ADM"),
	(8918, 8918, "M.", "PASLAREF", "Jean-Pierre", "D", "D1", "S1 S2 S3 S4 S5 S6", "STI2D", "S2", "ADM"),
	(8811, 8811, "Mme.", "FONTAINE", "Ondine", "B", "B2", "S1 S2 S3 S4", "NBGE", "S2", "ADM");

INSERT into Etudiant (etu_id, codenip, rang, civ, nom, prenom, grpTD, grpTP, cursus, bac, specialite, passage, decision) VALUES
	(8884, 8884, "Mme.", "PASDECEINTURE", "Jean-Michel", "B", "B2", "S1 S2 S1", "S", "SCIENCES","S2", "NAR");
	(8874, 8874, "Mme.", "AFEE", "Mack", "B", "B2", "S1 S2", "S", "SCIENCES","S2", "NAR");