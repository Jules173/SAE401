$(document).ready(function() {
	setTimeout(() => $(".stop-animation").removeClass("stop-animation"), 500);
	$(".display-info-button").on("click", function(e) {
		$(".display-info-button.selected").removeClass("selected");
		$(e.currentTarget).addClass("selected");
		$("#display-data-container > div").hide();
		const id = $(e.currentTarget).attr("id");
		const name = id.substr(0, id.indexOf("-"));
		$("#display-data-container > div[id=" + name + "-table-container]").css("display", "flex");
	});
	$(".semester-button").on("click", function(e) {
		$(".semester-button").removeClass("selected");
		$(this).addClass("selected");
	});
});