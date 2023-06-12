function togglePassword(id) {
  let passwordField = document.getElementById(id);
  let toggleIcon = document.getElementById(id + '-toggle-icon');

  if (passwordField.type === 'password') {
    passwordField.type = 'text';
    toggleIcon.classList.toggle("fa-eye")
    toggleIcon.classList.remove('fa-eye-slash');
  } else {
    passwordField.type = 'password';
    toggleIcon.classList.toggle("fa-eye-slash")
    toggleIcon.classList.remove('fa-eye');
  }
}