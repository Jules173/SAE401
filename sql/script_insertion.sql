INSERT INTO Users VALUES
	(1, 'compteinvite', 'mdpinvite', FALSE),
	(2, 'compteadmin' , 'mdpadmin' , TRUE);

INSERT INTO Etudiant (etu_id, codenip, civ, nom, prenom, grpTD, grpTP, bac) VALUES
	(8860, 8860, 'Mme.', 'GAROU'        , 'Lou'        , 'A', 'A1', 'NBGE'),
	(8810, 8810, 'M.'  , 'PASDECEINTURE', 'Jean-Michel', 'B', 'B1', 'NBGE'),
	(8918, 8918, 'Mme.', 'DELAFORET'    , 'Sylvie'     , 'B', 'B2', 'NBGE'),
	(8811, 8811, 'M.'  , 'ABBE'         , 'Cedric'     , 'C', 'C1', 'NBGE');

INSERT INTO Bin VALUES
	(1 , 'BINR101'),
	(2 , 'BINR102'),
	(3 , 'BINR103'),
	(4 , 'BINR104'),
	(5 , 'BINR105'),
	(6 , 'BINR106'),
	(7 , 'BINR107'),
	(8 , 'BINR108'),
	(9 , 'BINR109'),
	(10, 'BINR110'),
	(11, 'BINR111'),
	(12, 'BINS101'),
	(13, 'BINS102'),
	(14, 'BINS103'),
	(15, 'BINS104'),
	(16, 'BINS105'),
	(17, 'BINS106');

INSERT INTO Semestre VALUES
	(1, 'S1'),
	(2, 'S2'),
	(3, 'S3'),
	(4, 'S4'),
	(5, 'S5'),
	(6, 'S6');

INSERT INTO Administration VALUES
	(1, 3, 0, '2023-2024', 8860),
	(2, 2, 1, '2023-2024', 8810),
	(3, 3, 0, '2023-2024', 8918),
	(4, 2, 0, '2023-2024', 8811);

INSERT INTO Competence VALUES
	(1, 'BIN11', 1),
	(2, 'BIN12', 1),
	(3, 'BIN13', 1),
	(4, 'BIN14', 1),
	(5, 'BIN15', 1),
	(6, 'BIN16', 1);

INSERT INTO moyenne_competence VALUES
	(8860, 1, 0.16, 'ADM'),
	(8918, 1, 0.32, 'ADM');

INSERT INTO moyenne_competence (etu_id, id_competence, decision) VALUES
	(8810, 1, 'ADM'),
	(8811, 1, 'ADM');

INSERT INTO validation (etu_id, id_semestre, decision, passage) VALUES
	(8860, 1, 'ADM', 'S2'),
	(8810, 1, 'ADM', 'S2'),
	(8918, 1, 'ADM', 'S2'),
	(8811, 1, 'ADM', 'S2');

INSERT INTO Attribution VALUES
	(1, 1 , 46),
	(1, 2 , 8 ),
	(1, 10, 6 ),
	(2, 1 , 30),
	(2, 6 , 10),
	(2, 7 , 20),
	(3, 3 , 20),
	(3, 4 , 20),
	(3, 10, 12),
	(3, 8 , 8),
	(4, 5 , 36),
	(4, 6 , 18),
	(4, 9 , 6),
	(5, 1 , 5),
	(5, 2 , 13),
	(5, 5 , 4),
	(5, 8 , 23),
	(5, 11, 15),
	(6, 1 , 4),
	(6, 2 , 5),
	(6, 8 , 9),
	(6, 9 , 12),
	(6, 10, 12),
	(6, 11, 12),
	(6, 12, 6);

INSERT INTO moyenne_eleve VALUES
	(8860, 1, 16.28),
	(8810, 1, 17.41),
	(8918, 1, 18.74),
	(8811, 1, 18.85),
	(8860, 2, 16.20),
	(8810, 2, 17.87),
	(8918, 2, 19.12),
	(8811, 2, 17.18);

INSERT INTO Promotion VALUES
	(8860, 1, 'Initial', '2023-2024'),
	(8810, 1, 'Initial', '2023-2024'),
	(8918, 1, 'Initial', '2023-2024'),
	(8811, 1, 'Initial', '2023-2024');