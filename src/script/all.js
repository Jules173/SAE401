$(document).ready(function() {
	setTimeout(() => $(".stop-animation").removeClass("stop-animation"), 1000);
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
		$(this).addClass("selected");
		$("#student-table-wrapper > div").removeAttr("style");
		const id = $(this).attr("id");
		$("#" + id.substr(0, id.indexOf("-"))).css("display", "flex");
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
	// Le clic sur les boutons de navigation
	$(".nav-button").on("click", function(e) {
		$(".nav-button").removeClass("selected");
		$(this).addClass("selected");
		$("#page-content > div").hide();
		$("#page-content > #" + $(this).attr("name") + "-wrapper").css("display", "flex");
	});
	$(".collapsible-show").on("click", function(e) {
		$(this).next().toggleClass("hidden");
	});
});

function filterFormHandle(e) {
	const data = new FormData(e.currentTarget);
	data.get("display-mode") === "year" ? loadPromotionYear() : loadPromotionSemester();
} 

/** Fonction qui permet de charger les étudiants de la promotion par année */
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
		
		// TODO: ajouter fetch de requête à l'api
		
	} else {
		$("#promotion-table").hide();
		$("#promotion-table").after($("<span>", {class: "no-data", text: "Veuillez sélectionner une année"}));
		
		$("#promotion-semester-select").children().remove();
		$("#promotion-semester-select").append($("<option>", {value: "", text: "Aucune année"}));
	}
}

/** Fonction qui permet de charger les étudiants de la promotion par semestre */
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
		
		// TODO: ajouter fetch de requête à l'api
		
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
	e.preventDefault();
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
	$(".file-input").off("change");
	$(".file-input").on("change", fileInputEvent);
	checkInputReady();
});

function fileInputEvent(e) {
	const file = $(this).prop("files")[0];
	$(this)[0].dataset['before'] = file?.name || "Aucun fichier choisi";
}

$(".file-input").on("change", fileInputEvent);

/** Fonction qui sert à vérifier si tout les fichiers sont sélectionnés, active/désactive le */
function checkInputReady() {
	let isReady = true;
	$("#import-container").find(".file-input").each(function(index, input) {
		if (input.files.length == 0)
			isReady = false;
	});
	$("#submit-import-button").removeAttr("disabled");
	if (!isReady)
		$("#submit-import-button").attr("disabled", "");
}

$("#submit-import-button").on("click", function(e) {
	e.preventDefault();
	checkInputReady();
	const data = new FormData($("#import-container")[0]);
	console.log(data);
	// TODO: ajouter fetch de submit à l'api
})

$(".import-box .file-input").on("change", function(e) {
	checkInputReady();
});

$("#visualize-commission-button").on("click", function(e) {
	e.preventDefault();
	e.stopPropagation();
	window.open("./commission.php", "_BLANK");
});