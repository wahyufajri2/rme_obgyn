const passwordInput = document.getElementById('password');
const showPassword = document.getElementById('showPassword');

showPassword.addEventListener('click', function () {
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    showPassword.classList.remove("fa-solid fa-eye-slash");
    showPassword.classList.add("fa-solid fa-eye");
  } else {
    passwordInput.type = 'password';
    showPassword.classList.remove('fa-solid fa-eye');
    showPassword.classList.add('fa-solid fa-eye-slash');
  }
});

const passwordInput1 = document.getElementById('password1');
const showPassword1 = document.getElementById('showPassword1');

showPassword1.addEventListener('click', function () {
  if (passwordInput1.type === 'password') {
    passwordInput1.type = 'text';
    showPassword1.classList.remove("fa-solid fa-eye-slash");
    showPassword1.classList.add("fa-solid fa-eye");
  } else {
    passwordInput1.type = 'password';
    showPassword1.classList.remove('fa-solid fa-eye');
    showPassword1.classList.add('fa-solid fa-eye-slash');
  }
});

const passwordInput2 = document.getElementById('password2');
const showPassword2 = document.getElementById('showPassword2');

showPassword2.addEventListener('click', function () {
  if (passwordInput2.type === 'password') {
    passwordInput2.type = 'text';
    showPassword2.classList.remove("fa-solid fa-eye-slash");
    showPassword2.classList.add("fa-solid fa-eye");
  } else {
    passwordInput2.type = 'password';
    showPassword2.classList.remove('fa-solid fa-eye');
    showPassword2.classList.add('fa-solid fa-eye-slash');
  }
});