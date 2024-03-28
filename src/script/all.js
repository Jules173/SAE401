$(document).ready(function() {
	setTimeout(() => $(".stop-animation").removeClass("stop-animation"), 500);
	$("#display-header > button").on("click", function(e) {
		$("#display-header > button.selected").removeClass("selected");
		$(e.currentTarget).addClass("selected");
		$("#display-table-container > div").hide();
		const id = $(e.currentTarget).attr("id");
		const name = id.substr(0, id.indexOf("-"));
		$("#display-table-container > div[id=" + name + "-table]").css("display", "flex");
	});
});