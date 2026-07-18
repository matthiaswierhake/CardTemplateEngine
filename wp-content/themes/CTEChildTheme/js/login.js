const button = document.querySelector(".lsv-toggle-password");
const field  = document.getElementById("lsv-password");
const icon   = button.querySelector(".dashicons");

button.addEventListener("click", function () {

	if (field.type === "password") {

		field.type = "text";
		icon.classList.remove("dashicons-visibility");
		icon.classList.add("dashicons-hidden");

	} else {

		field.type = "password";
		icon.classList.remove("dashicons-hidden");
		icon.classList.add("dashicons-visibility");

	}

});