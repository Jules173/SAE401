$(document).ready(function() {
	setTimeout(() => $(".stop-animation").removeClass("stop-animation"), 500);
	$(".display-info-button").on("click", function(e) {
		$(".display-info-button.selected").removeClass("selected");
		$(e.currentTarget).addClass("selected");
		$("#display-data-container > div").hide();
		const id = $(e.currentTarget).attr("id");
		const name = id.substr(0, id.indexOf("-"));
		const displayValue = $("#" + name + "-table-container").data("display");
		$("#" + name + "-table-container").css("display", displayValue);
	});
	$(".semester-button").on("click", function(e) {
		$(".semester-button").removeClass("selected");
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