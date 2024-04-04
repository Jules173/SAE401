<?php


/**
 * Classe controleur de la partie étudiant.
 * 
 * @author BOULOCHE Eléonore
 * @version 1.0
 */


 

require_once ( "../Entity/Etudiant.php"           );

require_once ( "../Repository/EtudiantBDD.php"    );
require_once ( "../Repository/AttributionBDD.php" );
require_once ( "../Repository/ValidationBDD.php"  );
require_once ( "../Repository/MoyenneEleveBDD.php"  );
require_once ( "../Repository/BinBDD.php"  );



class EtudiantControleur
{
	public function getInfosEtudByID ($etudiantID) {
		$etudBDD = new EtudiantBDD();
		$etud = $etudBDD->getEtudiantByID($etudiantID);


		return json_encode($etud);
	}


	public function getInfosEtudByNomPrenom ($etudiantNom, $etudiantPrenom) {
		$etudBDD = new EtudiantBDD();
		$etud = $etudBDD->getEtudiantByNomPrenom($etudiantNom, $etudiantPrenom);


		return json_encode($etud);
	}





	public function getMoyByBin ( $idBin, $idEtu ) {
		$moyenne = new MoyenneEleveBDD();
		return $moyenne->getMoyenneByBin($idBin, $idEtu);
	}

}




$e = new EtudiantControleur();
print_r($e->getMoyByBin(1, 1));