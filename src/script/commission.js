async function uploadImage(name) {
	const data = new FormData(document.forms[0]);
	data.append("file", name);
	const request = await fetch("./get_images.php", {
		method: "POST",
		body: data
	});
	return await request.json();
}
$(".remove-image-button").on("click", function(e) {
	$(this).hide();
	$(this).siblings("img").attr("src", "");
	const id = $(this).data("id");
	$("#" + id).val("");
	e.stopPropagation();
});
$("#left-image, #right-image, #chief-signature").on("change", async function(e) {
	const id = $(this).attr("id");
	let filePath = await uploadImage(id);
	filePath = filePath[id + "-path"];
	if (filePath) {
		$("#" + id + "-wrapper > img").attr("src", filePath);
		$("#" + id + "-path").val(filePath);
		$("#" + id + "-wrapper > .remove-image-button").show();
		console.log(filePath);
	}
});
$("#left-image-wrapper").on("click", () => $("#left-image").click());
$("#right-image-wrapper").on("click", () => $("#right-image").click());
$("#chief-signature-wrapper").on("click", () => $("#chief-signature").click());