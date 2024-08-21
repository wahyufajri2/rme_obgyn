// Script untuk menampilkan password di halaman login
document.addEventListener("DOMContentLoaded", function () {
	const icon = document.getElementById("icon");
	const passwordInput = document.getElementById("kata_sandi");

	if (icon && passwordInput) {
		icon.addEventListener("click", function () {
			// Toggle ikon mata
			this.classList.toggle("fa-eye-slash");
			this.classList.toggle("fa-eye");

			// Toggle tipe input
			if (passwordInput.type === "password") {
				passwordInput.type = "text";
			} else {
				passwordInput.type = "password";
			}
		});
	} else {
		console.error("Elemen icon atau passwordInput tidak ditemukan!");
	}
});

// Script untuk menampilkan password di halaman registrasi oleh admin
const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("kata_sandi1");
const togglePasswordConfirm = document.getElementById("togglePasswordConfirm");
const passwordConfirmInput = document.getElementById("kata_sandi2");

passwordInput.addEventListener("input", function () {
	togglePassword.style.display = this.value ? "block" : "none";
});

passwordConfirmInput.addEventListener("input", function () {
	togglePasswordConfirm.style.display = this.value ? "block" : "none";
});

togglePassword.addEventListener("click", function () {
	const type =
		passwordInput.getAttribute("type") === "password" ? "text" : "password";
	passwordInput.setAttribute("type", type);
	this.classList.toggle("fa-eye");
	this.classList.toggle("fa-eye-slash");
});

togglePasswordConfirm.addEventListener("click", function () {
	const type =
		passwordConfirmInput.getAttribute("type") === "password"
			? "text"
			: "password";
	passwordConfirmInput.setAttribute("type", type);
	this.classList.toggle("fa-eye");
	this.classList.toggle("fa-eye-slash");
});

// Script untuk checkbox di akses akun
document.addEventListener("DOMContentLoaded", function () {
	const checkboxes = document.querySelectorAll(".form-check-input");

	checkboxes.forEach((checkbox) => {
		checkbox.addEventListener("click", function () {
			const menuId = this.dataset.menu;
			const roleId = this.dataset.role;

			fetch("<?= base_url('admin/ubahAkses'); ?>", {
				method: "POST",
				headers: {
					"Content-Type": "application/x-www-form-urlencoded",
				},
				body: new URLSearchParams({
					menuId: menuId,
					roleId: roleId,
				}),
			})
				.then((response) => {
					if (response.ok) {
						window.location.href =
							"<?= base_url('admin/aksesAkun/'); ?>" + roleId;
					} else {
						// Tangani jika ada error dari server (misalnya, tampilkan pesan error)
						console.error("Error:", response.status);
					}
				})
				.catch((error) => {
					// Tangani jika ada error jaringan
					console.error("Error:", error);
				});
		});
	});
});
