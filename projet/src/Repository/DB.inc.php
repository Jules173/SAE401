<?php

namespace App\Repository;

use App\Repository\AdministrationBDD;
use App\Repository\AttributionBDD;
use App\Repository\BinBDD;
use App\Repository\CompetenceBDD;
use App\Repository\EtudiantBDD;
use App\Repository\MoyenneCompetenceBDD;
use App\Repository\MoyenneEleveBDD;
use App\Repository\SemestreBDD;
use App\Repository\UserBDD;
use App\Repository\ValidationBDD;

/*IL FAUT METTRE LES FICHIERS OBJETS EN REQUIRE*/
// require 'AdministrationBDD.php';
// require 'AttributionBDDphp';
// require 'BinBDD.php';
// require 'CompetenceBDD.php';
// require 'EtudiantBDDphp';
// require 'MoyenneCompetenceBDD.php';
// require 'MoyenneEleveBDD.php';
// require 'SemestreBDDphp';
// require 'UserBDD.php';
// require 'ValidationBDD.php';

class DB {
    private static $instance = null;
    private $connect = null;

    private function __construct()
    {
        $connStr = 'pgsql:host=localhost port=5432 dbname=postgres'; // A MODIFIER !
        try {
            // $this->connect = new PDO($connStr, 'postgres', 'toor'); //A MODIFIER !
            $this->connect = new PDO($connStr, 'postgres', 'JK2l!E5R'); //A MODIFIER !
            $this->connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "probleme de connexion :" . $e->getMessage();
            return null;
        }
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            try {
                self::$instance = new DB();
            } catch (PDOException $e) {
                echo $e;
            }
        }
        $obj = self::$instance;

        if (($obj->connect) == null) {
            self::$instance = null;
        }
        return self::$instance;
    }

    public function close()
    {
        $this->connect = null;
    }

    private function execQuery($requete, $tparam, $nomClasse)
    {
        $stmt = $this->connect->prepare($requete);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $nomClasse);
        if ($tparam != null) {
            $stmt->execute($tparam);
        } else {
            $stmt->execute();
        }
        $tab = array();
        $tuple = $stmt->fetch();
        if ($tuple) {
            while ($tuple != false) {
                $tab[] = $tuple;
                $tuple = $stmt->fetch();
            }
        }
        return $tab;
    }

    private function execMaj($ordreSQL, $tparam)
    {
        $stmt = $this->connect->prepare($ordreSQL);
        $res = $stmt->execute($tparam);
        return $stmt->rowCount();
    }

    /* Getters */

    public function getMoyBin($etu_id, $id_bin)
    {
        $requete = 'select moyenne from moyenneEleve where etu_id = ? and id_bin = ?';
        return $this->execQuery($requete, null, 'moyenneEleve');
    }

    public function getDecisionSemestre($etu_id, $id_semestre)
    {
        $requete = 'select decision from validation where etu_id = ? and id_semestre = ?';
        return $this->execQuery($requete, array($etu_id, $id_semestre), 'validation');
    }

    public function getCoeff($idBin, $idComp)
    {
        $requete = 'SELECT coeff FROM attribution WHERE idBin = ? AND idComp = ?';
        return $this->execQuery($requete, [$idBin, $idComp], 'attribution');
    }

    public function getBin($nomBin)
    {
        $requete = 'SELECT idBin FROM bin WHERE nomBin = ?;';
        return $this->execQuery($requete, [$nomBin], 'bin');
    }

    public function getComp($codeComp, $idSemestre)
    {
        $requete = 'SELECT idComp FROM competence WHERE nom = ? AND idSemestre = ?;';
        return $this->execQuery($requete, [$codeComp, $idSemestre], 'competence');
    }

    public function getSemestre($semestre, $year)
    {
        $requete = 'SELECT idSemestre FROM semestre WHERE semestre = ? AND annee = ?;';
        return $this->execQuery($requete, [$semestre, $year], 'semestre');
    }

    /* Updates */

    /* Etudiant */

    public function updateEtudiant($nom, $prenom, $etu_id)
    {
        $requete = 'update etudiant set nom = ?, prenom = ? where etu_id = ?';
        $tparam = array($nom, $prenom, $etu_id);
        return $this->execMaj($requete, $tparam);
    }

    public function updateGrpTD($grp, $etu_id)
    {
        $requete = 'update etudiant set grpTD = ? where etu_id = ?';
        $tparam = array($grp, $etu_id);
        return $this->execMaj($requete, $tparam);
    }

    public function updateGrpTP($grp, $etu_id)
    {
        $requete = 'update etudiant set grpTP = ? where etu_id = ?';
        $tparam = array($grp, $etu_id);
        return $this->execMaj($requete, $tparam);
    }

    /* Administration */

    public function updateAbsence($nbAbs, $etu_id, $annee)
    {
        $requete = 'update Administration set absence = ? where etu_id = ? and annee = ?';
        $tparam = array($nbAbs, $etu_id, $annee);
        return $this->execMaj($requete, $tparam);
    }

    public function updateJustifAbs($nbJustifAbs, $etu_id, $annee)
    {
        $requete = 'update Administration set nb_justif_absence = ? where etu_id = ? and annee = ?';
        $tparam = array($nbJustifAbs, $etu_id, $annee);
        return $this->execMaj($requete, $tparam);
    }

    /* moyenne_competence */

    public function updateBonus($bonus, $etu_id, $id_comp)
    {
        $requete = 'update moyenne_competence set bonus = ? where etu_id = ? and id_competence = ?';
        $tparam = array($bonus, $etu_id, $id_comp);
        return $this->execMaj($requete, $tparam);
    }

    public function updateDecisionCompetence($decision, $etu_id, $id_comp)
    {
        $requete = 'update moyenne_competence set decision = ? where etu_id = ? and id_competence = ?';
        $tparam = array($decision, $etu_id, $id_comp);
        return $this->execMaj($requete, $tparam);
    }

    /* Promotion */

    public function updateStatus($status, $etu_id, $id_semestre)
    {
        $requete = 'update Promotion set nom_status = ? where etu_id = ? and id_semestre = ?';
        $tparam = array($status, $etu_id, $id_semestre);
        return $this->execMaj($requete, $tparam);
    }

    public function updateAnneeProm($annee, $etu_id, $id_semestre)
    {
        $requete = 'update Promotion set annee = ? where etu_id = ? and id_semestre = ?';
        $tparam = array($annee, $etu_id, $id_semestre);
        return $this->execMaj($requete, $tparam);
    }

    /* Bin */

    public function updateBin($nom, $id_bin)
    {
        $requete = 'update Bin set nom_bin = ? where id_bin = ?';
        $tparam = array($nom, $id_bin);
        return $this->execMaj($requete, $tparam);
    }

    /* Semestre */

    public function updateSemestre($semestre, $id_semestre)
    {
        $requete = 'update Semestre set semestre = ? where id_semestre = ?';
        $tparam = array($semestre, $id_semestre);
        return $this->execMaj($requete, $tparam);
    }

    /* Competence */

    public function updateCompetence($nom, $id_comp)
    {
        $requete = 'update Competence set nom_comp = ? where id_comp = ?';
        $tparam = array($nom, $id_comp);
        return $this->execMaj($requete, $tparam);
    }

    /* validation */

    public function updateDecisionValidation($decision, $etu_id, $id_semestre)
    {
        $requete = 'update validation set decision = ? where etu_id = ? and id_semestre = ?';
        $tparam = array($decision, $etu_id, $id_semestre);
        return $this->execMaj($requete, $tparam);
    }

    public function updatePassage($passage, $etu_id, $id_semestre)
    {
        $requete = 'update validation set passage = ? where etu_id = ? and id_semestre = ?';
        $tparam = array($passage, $etu_id, $id_semestre);
        return $this->execMaj($requete, $tparam);
    }

    public function updateMotif($motif, $etu_id, $id_semestre)
    {
        $requete = 'update validation set motif = ? where etu_id = ? and id_semestre = ?';
        $tparam = array($motif, $etu_id, $id_semestre);
        return $this->execMaj($requete, $tparam);
    }

    public function updateTypeAdm($type_adm, $etu_id, $id_semestre)
    {
        $requete = 'update validation set type_adm = ? where etu_id = ? and id_semestre = ?';
        $tparam = array($type_adm, $etu_id, $id_semestre);
        return $this->execMaj($requete, $tparam);
    }

    public function updateRangAdm($rang_adm, $etu_id, $id_semestre)
    {
        $requete = 'update validation set rang_adm = ? where etu_id = ? and id_semestre = ?';
        $tparam = array($rang_adm, $etu_id, $id_semestre);
        return $this->execMaj($requete, $tparam);
    }

    /* Attribution */

    public function updateAttribution($coeff, $id_comp, $id_bin)
    {
        $requete = 'update Attribution set coeff = ? where id_comp = ? and id_bin = ?';
        $tparam = array($coeff, $id_comp, $id_bin);
        return $this->execMaj($requete, $tparam);
    }

    /* moyenne_eleve */

    public function updateMoyenne($moyenne, $etu_id, $id_bin)
    {
        $requete = 'update moyenne_eleve set moyenne = ? where etu_id = ? and id_bin = ?';
        $tparam = array($moyenne, $etu_id, $id_bin);
        return $this->execMaj($requete, $tparam);
    }

    /* Insertions */

    /* INSERTION POUR LA TABLE Etudiant */
    public function insertEtudiant($codenip, $civ, $nom, $prenom, $grpTD, $grpTP, $bac, $specialite)
    {
        $requete = 'INSERT INTO Etudiant (codenip, civ, nom, prenom, grpTD, grpTP, bac, specialite)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $tparam = array($codenip, $civ, $nom, $prenom, $grpTD, $grpTP, $bac, $specialite);
        return $this->execMaj($requete, $tparam);
    }

    /* INSERTION POUR LA TABLE Administration */
    public function insertAdministration($absence, $nombreAbsenceJustifiees, $annee, $idEtu)
    {
        $requete = 'INSERT INTO Administration (absence, nombreAbsenceJustifiees, annee, idEtu)
                    VALUES (?, ?, ?, ?)';
        $tparam = array($absence, $nombreAbsenceJustifiees, $annee, $idEtu);
        return $this->execMaj($requete, $tparam);
    }

    /* INSERTION POUR LA TABLE Bin */
    public function insertBin($nomBin, $codeBin)
    {
        $requete = 'INSERT INTO Bin (nomBin, codeBin)
                    VALUES (?, ?)';
        $tparam = array($nomBin, $codeBin);
        return $this->execMaj($requete, $tparam);
    }

    /* INSERTION POUR LA TABLE MoyenneEleve */
    public function insertMoyenneEleve($idEtu, $idBin, $moyenne, $annee)
    {
        $requete = 'INSERT INTO MoyenneEleve (idEtu, idBin, moyenne, annee)
                    VALUES (?, ?, ?, ?)';
        $tparam = array($idEtu, $idBin, $moyenne, $annee);
        return $this->execMaj($requete, $tparam);
    }

    /* INSERTION POUR LA TABLE Semestre */
    public function insertSemestre($semestre, $annee)
    {
        $requete = 'INSERT INTO Semestre (semestre, annee)
                    VALUES (?, ?)';
        $tparam = array($semestre, $annee);
        return $this->execMaj($requete, $tparam);
    }

    /* INSERTION POUR LA TABLE Competence */
    public function insertCompetence($nom, $code, $idSemestre)
    {
        $requete = 'INSERT INTO Competence (nom, code, idSemestre)
                    VALUES (?, ?, ?)';
        $tparam = array($nom, $code, $idSemestre);
        return $this->execMaj($requete, $tparam);
    }

    /* INSERTION POUR LA TABLE MoyenneCompetence */
    public function insertMoyenneCompetence($idComp, $idEtu, $bonus, $decision)
    {
        $requete = 'INSERT INTO MoyenneCompetence (idComp, idEtu, bonus, decision)
                    VALUES (?, ?, ?, ?)';
        $tparam = array($idComp, $idEtu, $bonus, $decision);
        return $this->execMaj($requete, $tparam);
    }

    /* INSERTION POUR LA TABLE Attribution */
    public function insertAttribution($idComp, $idBin, $coeff)
    {
        $requete = 'INSERT INTO Attribution (idComp, idBin, coeff)
                    VALUES (?, ?, ?)';
        $tparam = array($idComp, $idBin, $coeff);
        return $this->execMaj($requete, $tparam);
    }

    /* INSERTION POUR LA TABLE Validation */
    public function insertValidation($idEtu, $idSemestre, $decision, $motif, $typeAdm, $annee)
    {
        $requete = 'INSERT INTO Validation (idEtu, idSemestre, decision, motif, typeAdm, annee)
                    VALUES (?, ?, ?, ?, ?, ?)';
        $tparam = array($idEtu, $idSemestre, $decision, $motif, $typeAdm, $annee);
        return $this->execMaj($requete, $tparam);
    }

    /* INSERTION POUR LA TABLE User */
    public function insertUser($nom, $mdp, $statut)
    {
        $requete = 'INSERT INTO User (nom, mdp, statut)
                    VALUES (?, ?, ?)';
        $tparam = array($nom, $mdp, $statut);
        return $this->execMaj($requete, $tparam);
    }

    public function ifExist($valeur, $table, $champ, $pdo)
    {
        $requete = "SELECT COUNT(*) FROM $table WHERE $champ = ?";
        $resultats = $this->execQuery($requete, [$valeur], null, $pdo);
        return $resultats[0][0] > 0;
    }

    public function ifExistss($valeur, $table, $champ1, $champ2, $pdo)
    {
        $requete = "SELECT COUNT(*) FROM $table WHERE $champ1 = ? AND $champ2  = ?";
        $resultats = $this->execQuery($requete, [$valeur], null, $pdo);
        return $resultats[0][0] > 0;
    }
} //fin classe DB

?>
