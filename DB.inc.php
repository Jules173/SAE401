<?php

	require 'client.inc.php';
	require 'produit.inc.php';
	require 'achat.inc.php';

	class DB {
		private static $instance = null;
		private $connect=null;
	
		private function __construct() {
			$connStr = 'pgsql:host=localhost port=5432 dbname=postgres'; // A MODIFIER ! 
			try {
				$this->connect = new PDO($connStr, 'postgres', 'toor'); //A MODIFIER !
			$this->connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); 
			$this->connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); 
			}
			catch (PDOException $e) {
						echo "probleme de connexion :".$e->getMessage();
				return null;    
			}
		}

		public static function getInstance() {
				if (is_null(self::$instance)) {
				try { 
				self::$instance = new DB(); 
			} 
			catch (PDOException $e) {
				echo $e;
			}
				}
			$obj = self::$instance;

			if (($obj->connect) == null) {
			self::$instance=null;
			}
			return self::$instance;
		}

		public function close() {
				$this->connect = null;
		}

		private function execQuery($requete,$tparam,$nomClasse) {
			$stmt = $this->connect->prepare($requete);
			$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $nomClasse);
			if ($tparam != null) {
				$stmt->execute($tparam);
			}
			else {
				$stmt->execute();
			}
			$tab = array();
			$tuple = $stmt->fetch();
			if ($tuple) {
					while ($tuple != false) {
				$tab[]=$tuple;
						$tuple = $stmt->fetch();      
				}        	     
				}
			return $tab;    
		}
	
		private function execMaj($ordreSQL,$tparam) {
			$stmt = $this->connect->prepare($ordreSQL);
			$res = $stmt->execute($tparam); 	     
			return $stmt->rowCount();
		}

		/*************************************************************************
		 * Fonctions qui peuvent être utilisées dans les scripts PHP
		 *************************************************************************/

		/*
		public function getTemplate($param1, $PKey1) {
			$requete = 'select Colonne from TABLE where PKey1 = ?';
			return $this->execQuery($requete,null,'TABLE');
		}

		public function updateTemplate($param1 ,$param2, $param3) {
			$requete = 'update TABLE set Modification = ? where PrimaryK1 = ? and PrimaryK2 = ?';
			$tparam = array($param1 ,$param2, $param3);
			return $this->execMaj($requete,$tparam);
		}

		public function deleteTemplate($param1) {
			$requete = 'delete from TABLE where PKey = ?';
			$tparam = array($param1);
			return $this->execMaj($requete,$tparam);
		}

		public function deleteUneColonneTemplate($param1 ,$param2) {
			$requete = 'update TABLE set Modification = NULL where PrimaryK1 = ? and PrimaryK2 = ?';
			$tparam = array($param1 ,$param2);
			return $this->execMaj($requete,$tparam);
		}
		*/

		  /*-------*/
		 /*Getters*/
		/*-------*/

		public function getMoyBin($etu_id, $id_bin) {
			$requete = 'select moyenne from moyenne_eleve where etu_id = ? and id_bin = ?';
			return $this->execQuery($requete,null,'validation');
		}    

		public function getDecisionSemestre($etu_id, $id_semestre) {
			$requete = 'select decision from validation where etu_id = ? and id_semestre = ?';
			return $this->execQuery($requete,array($adr),'validation');
		}

  		  /*-------*/
		 /*Updates*/
		/*-------*/
		
		/*Etudiant*/

		public function updateEtudiant($nom, $prenom, $etu_id) {
			$requete = 'update etudiant set nom = ?, prenom = ? where etu_id = ?';
			$tparam = array($nom, $prenom, $etu_id);
			return $this->execMaj($requete,$tparam);
		}

		public function updateGrpTD($grp, $etu_id) {
			$requete = 'update etudiant set grpTD = ? where etu_id = ?';
			$tparam = array($grp, $etu_id);
			return $this->execMaj($requete,$tparam);
		}

		public function updateGrpTP($grp, $etu_id) {
			$requete = 'update etudiant set grpTP = ? where etu_id = ?';
			$tparam = array($grp, $etu_id);
			return $this->execMaj($requete,$tparam);
		}

		/*Administration*/

		public function updateAbsence($nbAbs ,$etu_id, $annee) {
			$requete = 'update Administration set absence = ? where etu_id = ? and annee = ?';
			$tparam = array($nbAbs ,$etu_id, $annee);
			return $this->execMaj($requete,$tparam);
		}

		public function updateJustifAbs($nbJustifAbs ,$etu_id, $annee) {
			$requete = 'update Administration set nb_justif_absence = ? where etu_id = ? and annee = ?';
			$tparam = array($nbJustifAbs ,$etu_id, $annee);
			return $this->execMaj($requete,$tparam);
		}

		/*moyenne_competence*/

		public function updateBonus($bonus ,$etu_id, $id_comp) {
			$requete = 'update moyenne_competence set bonus = ? where etu_id = ? and id_competence = ?';
			$tparam = array($bonus ,$etu_id, $id_comp);
			return $this->execMaj($requete,$tparam);
		}

		public function updateDecisionCompetence($decision ,$etu_id, $id_comp) {
			$requete = 'update moyenne_competence set decision = ? where etu_id = ? and id_competence = ?';
			$tparam = array($decision ,$etu_id, $id_comp);
			return $this->execMaj($requete,$tparam);
		}

		/*Promotion*/

		public function updateStatus($status ,$etu_id, $id_semestre) {
			$requete = 'update Promotion set nom_status = ? where etu_id = ? and id_semestre = ?';
			$tparam = array($status ,$etu_id, $id_semestre);
			return $this->execMaj($requete,$tparam);
		}

		public function updateAnneeProm($annee ,$etu_id, $id_semestre) {
			$requete = 'update Promotion set annee = ? where etu_id = ? and id_semestre = ?';
			$tparam = array($annee ,$etu_id, $id_semestre);
			return $this->execMaj($requete,$tparam);
		}

		/*Bin*/

		public function updateBin($nom ,$id_bin) {
			$requete = 'update Bin set nom_bin = ? where id_bin = ?';
			$tparam = array($nom ,$id_bin);
			return $this->execMaj($requete,$tparam);
		}

		/*Semestre*/

		public function updateSemestre($semestre ,$id_semestre) {
			$requete = 'update Semestre set semestre = ? where id_semestre = ?';
			$tparam = array($semestre ,$id_semestre);
			return $this->execMaj($requete,$tparam);
		}

		/*Competence*/

		public function updateCompetence($nom, $id_comp) {
			$requete = 'update Competence set nom_comp = ? where id_comp = ?';
			$tparam = array($nom ,$id_comp);
			return $this->execMaj($requete,$tparam);
		}

		/*validation*/

		public function updateDecisionValidation($decision ,$etu_id, $id_semestre) {
			$requete = 'update validation set decision = ? where etu_id = ? and id_semestre = ?';
			$tparam = array($decision ,$etu_id, $id_semestre);
			return $this->execMaj($requete,$tparam);
		}
		
		public function updatePassage($passage ,$etu_id, $id_semestre) {
			$requete = 'update validation set passage = ? where etu_id = ? and id_semestre = ?';
			$tparam = array($passage ,$etu_id, $id_semestre);
			return $this->execMaj($requete,$tparam);
		}

		public function updateMotif($motif ,$etu_id, $id_semestre) {
			$requete = 'update validation set motif = ? where etu_id = ? and id_semestre = ?';
			$tparam = array($motif ,$etu_id, $id_semestre);
			return $this->execMaj($requete,$tparam);
		}

		public function updateTypeAdm($type_adm ,$etu_id, $id_semestre) {
			$requete = 'update validation set type_adm = ? where etu_id = ? and id_semestre = ?';
			$tparam = array($type_adm ,$etu_id, $id_semestre);
			return $this->execMaj($requete,$tparam);
		}

		public function updateRangAdm($rang_adm ,$etu_id, $id_semestre) {
			$requete = 'update validation set rang_adm = ? where etu_id = ? and id_semestre = ?';
			$tparam = array($rang_adm ,$etu_id, $id_semestre);
			return $this->execMaj($requete,$tparam);
		}

		/*Attribution*/

		public function updateAttribution($coeff ,$id_comp, $id_bin) {
			$requete = 'update Attribution set coeff = ? where id_comp = ? and id_bin = ?';
			$tparam = array($coeff ,$id_comp, $id_bin);
			return $this->execMaj($requete,$tparam);
		}

		/*moyenne_eleve*/

		public function updateMoyenne($moyenne ,$etu_id, $id_bin) {
			$requete = 'update moyenne_eleve set moyenne = ? where etu_id = ? and id_bin = ?';
			$tparam = array($moyenne ,$etu_id, $id_bin);
			return $this->execMaj($requete,$tparam);
		}

	} //fin classe DB

?>