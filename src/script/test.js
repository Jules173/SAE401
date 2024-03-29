$(document).on("change", 'input[type="file"]', function () {
  // Sélection de tous les champs de fichier
  var fileInputs = $('input[type="file"]');

  // Fonction pour vérifier si tous les champs de fichier sont remplis
  function checkAllFilesSelected() {
    var allFilesSelected = true;
    fileInputs.each(function () {
      if (!(this.files && this.files.length > 0)) {
        allFilesSelected = false;
        return false; // Sort de la boucle .each() dès qu'un champ de fichier vide est trouvé
      }
    });
    return allFilesSelected;
  }

  // Supprimer tous les gestionnaires d'événements 'change' sur les champs de fichier
  fileInputs.off("change");

  // Gestionnaire d'événements 'change' pour chaque champ de fichier
  fileInputs.on("change", function () {
    // Vérification si un fichier a été sélectionné
    if (this.files && this.files.length > 0) {
      // Vérification si tous les champs de fichier sont remplis
      if (checkAllFilesSelected()) {
        // Tous les champs de fichier sont remplis, effectuer une action
        $.ajax({
          url: "test2.php", // Le script PHP qui change la valeur de la variable
          type: "POST",
          data: { newValue: "Nouvelle valeur" }, // La nouvelle valeur pour la variable

          success: function () {
            // Sélection de la dernière ligne de la table
            var lastRow = $("table tr:last");

            // Comptage du nombre de td dans la dernière ligne
            var tdCount = lastRow.find("td").length;

            // Ajout dynamique du contenu en fonction du nombre de td dans la dernière ligne
            var contenuHtml = `
				  <td>
					<div id="import-box">
					  <h2>
						Année du semestre :
						<input type="number" id="int-input" name="year" value="2024" />
					  </h2>
					  <h3>
						Semestre <input type='number' id='int-input'/>
					  </h3>
					  <div id="import">
						<div id="grades-import-container">
						  <label for="grade-input-file">Fichier Excel des moyennes : </label><br />
						  <input type="file" id="grade-input-file" name="grades" />
						</div>
						<div id="jury-import-container">
						  <label for="jury-input-file">Fichier Excel des jury :</label><br />
						  <input type="file" id="jury-input-file" name="jury" />
						</div>
					  </div>
					</div>
				  </td>
				`;

            // Si le nombre de td dans la dernière ligne est pair, ajoute une nouvelle tr
            if (tdCount % 2 === 0) {
              $("table").append("<tr>" + contenuHtml + "</tr>");
            }
            // Sinon, ajoute simplement une nouvelle td à la dernière ligne
            else {
              lastRow.append(contenuHtml);
            }
          },
        });
      }
    }
  });
});

$(document).ready(function () {
  $(".drop-zone").on("dragover", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).addClass("hover");
  });

  $(".drop-zone").on("dragleave", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).removeClass("hover");
  });

  $(".drop-zone").on("drop", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).removeClass("hover");

    var files = e.originalEvent.dataTransfer.files;
    // Vous pouvez maintenant traiter les fichiers ici
    handleFiles(files);
  });

  function handleFiles(files) {
    // Code de traitement des fichiers ici
    console.log(files);
  }
});
