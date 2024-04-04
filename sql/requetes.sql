  /*---------------*/
 /*REQUETES UPDATE*/
/*---------------*/

UPDATE Etudiant
SET nom = $, prenom = $, grpTD = $, grpTP = $, bac = $, specialite = $
WHERE etu_id = $;

UPDATE Administration
SET absence = $, nb_justif_absence = $
WHERE etu_id = $;

UPDATE moyenne_competence
SET moyenneComp = $, bonus = $, decision = $
WHERE etu_id = $ AND id_competence = $;

UPDATE Promotion
SET nom_status = $, annee = $
WHERE etu_id = $ AND id_semestre = $;

UPDATE Bin
SET nom_bin = $
WHERE id_bin = $ ;

UPDATE Semestre
SET semestre = $
WHERE id_semestre = $ ;

UPDATE Competence
SET nom_comp = $
WHERE id_competence = $ ;

UPDATE validation
SET decision = $, passage = $, motif = $, type_adm = $, rang_adm = $
WHERE etu_id = $ and id_semestre = $;

UPDATE Attribution
SET coeff = $
WHERE id_competence = $ AND id_bin = $ ;

UPDATE moyenne_eleve
SET nom_status = $, annee = $
WHERE etu_id = $ AND id_semestre = $ ;

  /*---------------*/
 /*REQUETES DELETE*/
/*---------------*/

DELETE FROM Etudiant
WHERE etu_id = $;

DELETE FROM Administration
WHERE etu_id = $;

DELETE FROM moyenne_competence
WHERE etu_id = $ AND id_competence = $;

DELETE FROM Promotion
WHERE etu_id = $ AND id_semestre = $;

DELETE FROM Bin
WHERE id_bin = $ ;

DELETE FROM Semestre
WHERE id_semestre = $ ;

DELETE FROM Competence
WHERE id_competence = $ ;

DELETE FROM validation
WHERE etu_id = $ and id_semestre = $;

DELETE FROM Attribution
WHERE id_competence = $ AND id_bin = $ ;

DELETE FROM moyenne_eleve
WHERE etu_id = $ AND id_semestre = $ ;