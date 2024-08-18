document.addEventListener("DOMContentLoaded", function () {
	const showPasswordButton = document.getElementById("show_password");
	const icon = document.getElementById("icon");
	const passwordInput = document.getElementById("password");

	showPasswordButton.addEventListener("click", function () {
		console.log("Icon clicked!");
		icon.classList.toggle("fa-eye-slash");
		icon.classList.toggle("fa-eye");

		if (passwordInput.type === "password") {
			passwordInput.type = "text";
		} else {
			passwordInput.type = "password";
		}
	});
});
