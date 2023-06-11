/**
 * This function toggles the visibility of the password field.
 */
function togglePasswordVisibility() {
  if (password.type === "password") {
    password.type = "text";
  } else {
    password.type = "password";
  }
}

/**
 * This function toggles the visibility of the confirm password field.
 */
function toggleConfirmPasswordVisibility() {
  if (cPassword.type === "password") {
    cPassword.type = "text";
  } else {
    cPassword.type = "password";
  }
}