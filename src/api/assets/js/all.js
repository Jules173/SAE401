$(document).ready(function() {
	setTimeout(() => $(".stop-animation").removeClass("stop-animation"), 500);
	$(".display-info-button").on("click", function(e) {
		$("#student-commission-container").hide();
		$("[id*=-table-container][data-display]").hide();
		$(".display-info-button.selected").removeClass("selected");
		$(e.currentTarget).addClass("selected");
		$("#display-data-container > div").hide();
		const id = $(e.currentTarget).attr("id");
		const name = id.substr(0, id.indexOf("-"));
		const displayValue = $("#" + name + "-table-container").data("display");
		$("#" + name + "-table-container").css("display", displayValue).parent("#student-commission-container").show();
	});
	$(".semester-button").on("click", function(e) {
		$(".semester-button").removeClass("selected");
		if ($(this).hasClass("selected"))
			$(this).removeClass("selected");
		else
			$(this).addClass("selected");
	});
	$("#skills-display-wrapper input[type=checkbox]").on("change", function(e) {
		const id = parseInt($(this).attr("id")?.substr(1)) + 1;
		if (e.target.checked) {
			$("#promotion-table td:nth-child(" + id + "), #promotion-table th:nth-child(" + id + ")").show();
		} else {
			$("#promotion-table td:nth-child(" + id + "), #promotion-table th:nth-child(" + id + ")").hide();
		}
	});
	$("#export-btn").on("click", function(e) {
		e.preventDefault();
		e.stopPropagation();
	});
	$("#promotion-filter").on("change", filterFormHandle);
	loadPromotionYear();
});

function filterFormHandle(e) {
	const data = new FormData(e.currentTarget);
	data.get("display-mode") === "year" ? loadPromotionYear() : loadPromotionSemester();
} 

function loadPromotionYear() {
	const startDate = $("#start-date").val();
	const endDate = $("#end-date").val();
	$("#promotion-table-wrapper .no-data").remove();
	if (startDate && endDate) {
		const min = parseInt(startDate) < parseInt(endDate) ? parseInt(startDate) : parseInt(endDate);
		const max = parseInt(startDate) < parseInt(endDate) ? parseInt(endDate) : parseInt(startDate);
		$("#promotion-table").removeAttr("style");
		$("#promotion-table > tbody").children().remove();
		$("#promotion-semester-select").children().remove();
		
		for (let i = min; i <= max; i++)
			$("#promotion-semester-select").append($("<option>", {value: "" + i, text: "" + i}));
		
	} else {
		$("#promotion-table").hide();
		$("#promotion-table").after($("<span>", {class: "no-data", text: "Veuillez sélectionner une année"}));
		
		$("#promotion-semester-select").children().remove();
		$("#promotion-semester-select").append($("<option>", {value: "", text: "Aucune année"}));
	}
}

function loadPromotionSemester() {
	const startDate = $("#start-date").val();
	const endDate = $("#end-date").val();
	$("#promotion-table-wrapper .no-data").remove();
	if (startDate && endDate) {
		const min = parseInt(startDate) < parseInt(endDate) ? parseInt(startDate) : parseInt(endDate);
		const max = parseInt(startDate) < parseInt(endDate) ? parseInt(endDate) : parseInt(startDate);
		$("#promotion-table").removeAttr("style");
		$("#promotion-table > tbody").children().remove();
		$("#promotion-semester-select").children().remove();
		
		for (let i = 1; i <= 6; i++)
			$("#promotion-semester-select").append($("<option>", {value: "Semestre " + i, text: "Semestre " + i}));
		
	} else {
		$("#promotion-table").hide();
		$("#promotion-table").after($("<span>", {class: "no-data", text: "Veuillez sélectionner une année"}));
		
		$("#promotion-semester-select").children().remove();
		$("#promotion-semester-select").append($("<option>", {value: "", text: "Aucun semestre"}));
	}
}

function resetPromotionTable() {
	$("#promotion-table td, #promotion-table th").show();
}

$("#add-semester-button").on("click", function(e) {
	const index = $(".import-box").length + 1;
	$(this).parent().before($.parseHTML(`
	<div class="import-box">
		<h2>
			Année du semestre :
			<input type="number" class='semester-year' name="year" value="2024">
		</h2>
		<h3>
			Semestre
			<input type='number' class='semester'>
		</h3>
		<div class="import-files">
			<div class="grades-import-container">
				<label for="grade-input-file-${index}">Fichier Excel des moyennes : </label>
				<input type="file" id="grade-input-file-${index}" class='file-input' data-before='Aucun fichier choisi' name="grades" accept='application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.ods'>
			</div>
			<div class="jury-import-container">
				<label for="jury-input-file-${index}">Fichier Excel des jury :</label>
				<input type="file" id="jury-input-file-${index}" class='file-input' data-before='Aucun fichier choisi' name="jury" accept='application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.ods'>
			</div>
		</div>
	</div>`));
	$(".excel-file-input").off("change");
	$(".excel-file-input").on("change", excelInputEvent);
});

function excelInputEvent(e) {
	const file = $(this).prop("files")[0];
	$(this)[0].dataset['before'] = file?.name || "Aucun fichier choisi";
}

$(".excel-file-input").on("change", excelInputEvent);

$("#visualize-commission-button").on("click", function(e) {
	e.preventDefault();
	e.stopPropagation();
	window.open("./commission.php", "_BLANK");
});

$(document).on("keyleft", 'input[type="file"]', function () {
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
		  url: "index.php", // Le script PHP qui change la valeur de la variable
		  type: "POST",
		  data: { newValue: "Nouvelle valeur" }, // La nouvelle valeur pour la variable

		  success: function () {
			// Sélection de la dernière ligne de la table
			var lastRow = $("table tr:last");

			// Comptage du nombre de td dans la dernière ligne
			var tdCount = lastRow.find("td").length;

			// Ajout dynamique du contenu en fonction du nombre de td dans la dernière ligne
			var contenuHtml = `
			<div class="import-box">
				<h2>
					Année du semestre :
					<input type="number" class='semester-year' name="year" value="2024">
				</h2>
				<h3>
					Semestre
					<input type='number' class='semester'>
				</h3>
				<div class="import-files">
					<div class="grades-import-container">
						<label for="grade-input-file">Fichier Excel des moyennes : </label>
						<br>
						<input type="file" id="grade-input-file" name="grades" accept='application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.ods'>
					</div>
					<div class="jury-import-container">
						<label for="jury-input-file">Fichier Excel des jury :</label>
						<br>
						<input type="file" id="jury-input-file" name="jury" accept='application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.ods'>
					</div>
				</div>
			</div>`;
			$("#import-container").append($.parseHTML(contenuHtml));

			// Si le nombre de td dans la dernière ligne est pair, ajoute une nouvelle tr
			// if (tdCount % 2 === 0) {
			  // $("table").append("<tr>" + contenuHtml + "</tr>");
			// }
			// Sinon, ajoute simplement une nouvelle td à la dernière ligne
			// else {
			  // lastRow.append(contenuHtml);
			// }
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