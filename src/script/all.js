$(document).ready(function() {
	setTimeout(() => $(".stop-animation").removeClass("stop-animation"), 1000);
	$("#display-header > button").on("click", function(e) {
		$("#display-header > button.selected").removeClass("selected");
		$(e.currentTarget).addClass("selected");
	});
});