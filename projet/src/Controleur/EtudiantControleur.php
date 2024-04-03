<?php


/**
 * Classe controleur de la partie étudiant.
 * 
 * @author BOULOCHE Eléonore
 * @version 1.0
 */


 

include_once ( '..\Entity\Etudiant'        );
include_once ( '..\Entity\Attribution'     );
include_once ( '..\Entity\Validation'      );
include_once ( '..\Entity\Semestre'        );
include_once ( '..\Entity\Bin'             );
include_once ( '..\Entity\MoyenneEtudiant' );

include_once ( '..\Repository\EtudiantBDD'        );
include_once ( '..\Repository\AttributionBDD'     );
include_once ( '..\Repository\ValidationBDD'      );
include_once ( '..\Repository\SemestreBDD'        );
include_once ( '..\Repository\BinBDD'             );
include_once ( '..\Repository\MoyenneEtudiantBDD' );



class EtudiantControleur
{
	public function getInfosEtudByID ($etudiantID) {
		$etudBDD = new EtudiantBDD();
		$etud = $etudBDD->getEtudiantByID($etudiantID);


		return $etud;
	}


	public function getInfosEtudByNomPrenom ($etudiantNom, $etudiantPrenom) {
		$etudBDD = new EtudiantBDD();
		$etud = $etudBDD->getEtudiantByNomPrenom($etudiantNom, $etudiantPrenom);


		return $etud;
	}



	public function getCompBySemestres ( $etudiantNom, $etudiantPrenom ) {
		$etud = $this->getInfosEtudByNomPrenom($etudiantNom, $etudiantPrenom);

		$validation = new ValidationBDD();
		$validation = $validation->getSemestreByAnnee( $validation->getDebutAnneeEtudes($etud->getIdEtu()),
		                                               $validation->getFinAnneeEtudes  ($etud->getIdEtu()) );



		$attribution = new AttributionBDD();
		

		$tabAttribution = array();
		foreach ($semestre as $sem) {
			$attribution = $attribution->getCompBySemestre($sem->getSemestre());

			foreach ( $attribution as $att )
				$tabAttribution[] = $att->getCompetence();
		}


		return $tabAttribution;
	}



	public function getBinByIDComp ( $idComp ) {
		$attribution = new AttributionBDD();
		$attribution = $attribution->getBinByIDComp($idComp);

		$tabBin = array();
		foreach ( $attribution as $att )
			$tabBin[] = $att->$att->getBin();


		return $tabBin;
	}



	public function getMoyenneByIDComp ( $idComp ) {
		$attribution = new AttributionBDD();
		$moyenneEleve = new MoyenneEleveBDD();


		$attribution = getBinByIDComp($idComp);
		$moyenneCompetence = 0;

		foreach ( $attribution as $bin)
			$moyenneCompetence += $bin->getMoyenneByIDComp($idComp) * $bin->getMoyenne();

		return $moyenneCompetence ;
	}



	public function getMoyByBin ( $idBin ) {
		$bin = new BinBDD();
		$bin = $bin->getBinByID($idBin);

		$moyenne = new MoyenneEtudiantBDD();
		return $moyenne->getMoyenneByBin($idBin);
	}




	// UPDATE
	public function updateMoyenneEtudiant ( $idEtu, $idBin, $moyenne ) {
		$moyenneEtudiant = new MoyenneEtudiantBDD();
		$moyenneEtudiant->updateMoyenneEtudiant($idEtu, $idBin, $moyenne);
	}


	public function updateAbsenceEtudiant ( $idEtu, $annee, $nbAbsences, $nbAbsencesJustifiees ) {
		$etudiant = new EtudiantBDD();
		$etudiant->updateAbsenceEtudiant($idEtu, $annee, $nbAbsences, $nbAbsencesJustifiees);
	}




	// FILTRES


}


