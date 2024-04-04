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

$("#generate-pdf").on("click", function () {
	// Options de conversion
	const options = {
		filename: "document.pdf",
		image: {
			type: "jpeg",
			quality: 1
		},
		html2canvas: { // Facteur d'échelle pour la capture d'écran HTML
			scale: 1,
			width: 793,
			height: 1123
		}, 
		jsPDF: { // Options pour jsPDF
			unit: "px",
			format: "a4",
			orientation: "portrait"
		}
	};
	// const options = {
		// margin: 10,
		// filename: 'document.pdf',
		// image: {
			// type: 'jpeg',
			// quality: 1
		// },
		// html2canvas: {
			// dpi: 300,
			// letterRendering: true,
			// scale: 2,
			// width: 793,
			// height: 1123
		// },
		// jsPDF: {
			// unit: 'mm',
			// format: 'a4',
			// orientation: 'portrait'
		// },
		// pagebreak: {
			// mode: ['avoid-all', 'css']
		// }
	// };
	$("#commission-container")
	// .css("transform", "scale(0.8)")
	.css("height", "842pt")
	.css("width", "595pt");
	// Convertir HTML en PDF
	html2pdf().from($("#commission-container")[0])
	.set(options)
	.save()
	.then(() => {
		$("#commission-container").removeAttr("style");
		console.clear();
	})
	.catch((error) => {
		console.info(error);
	});
});