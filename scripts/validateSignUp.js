let emailAddress = document.getElementById("email_address")
let password = document.getElementById("password")
let cPassword = document.getElementById("cpassword")
let error_message = document.getElementById("error_message")


let passwordRegex = /(?=.*\d)(?=.*[!@#$%^&])(?=.*[a-z])(?=.*[A-Z]).{8,20}$/
let emailRegex = /^[a-zA-Z]\w*@\w+(\.\w{2,3})+$/

/**
 * This function validates the password input field. It checks if the password is at least 8 characters long, contains at least one special character: !@$#%&, at least one number, at least one upper case letter, and at least one lower case letter.
 * @param {*} entry 
 */
function passwordValidation (entry) {
    let currentValue = entry.target.value
    let valid = passwordRegex.test(currentValue)

    if(valid) {
        password.style.borderColor = 'green'
        password.style.borderStyle = 'solid'
        password.style.borderWidth = '0.025px'
        error_message.innerText = ""
    }

    if (currentValue.length == 0) {
        password.style.borderColor = 'gray'
        password.style.borderStyle = 'solid'
        password.style.borderWidth = '0.025px'
        error_message.innerText = ""
    }

    if (!valid && currentValue.length != 0) {
        password.style.borderColor = 'red'
        password.style.borderStyle = 'solid'
        password.style.borderWidth = '0.025px'
        error_message.innerText = 
        "Password must be between 8-20 characters long, contain at least one special character: !@$#%&, at least one number, at least one upper case letter, and at least one lower case letter."
    }
}


/**
 * This function validates the email address input field. It checks if the email address is in the correct format.
 * @param {*} entry 
 */
function emailValidation (entry) {
    let currentValue = entry.target.value
    let valid = emailRegex.test(currentValue)

    if (valid) {
        emailAddress.style.borderColor = 'green'
        emailAddress.style.borderStyle = 'solid'
        emailAddress.style.borderWidth = '0.025px'
    }

    if (currentValue.length == 0) {
        emailAddress.style.borderColor = 'gray'
        emailAddress.style.borderStyle = 'solid'
        emailAddress.style.borderWidth = '0.025px'
    }

    if (!valid && currentValue.length != 0) {
        emailAddress.style.borderColor = 'red'
        emailAddress.style.borderStyle = 'solid'
        emailAddress.style.borderWidth = '0.025px'
    }
}

/**
 * This function checks if the password and confirm password fields match.
 * @returns boolean
 */
function confirmPassword () {
    if (password.value != cPassword.value) {
        cPassword.style.borderColor = 'red'
        cPassword.style.borderStyle = 'solid'
        cPassword.style.borderWidth = '0.025px'
        error_message.innerText = "Passwords do not match."
        return false
    }

    if (password.value == cPassword.value && cPassword.value.length != 0) {
        cPassword.style.borderColor = 'green'
        cPassword.style.borderStyle = 'solid'
        cPassword.style.borderWidth = '0.025px'
        error_message.innerText = ""
        return true
    }

    if (cPassword.value.length == 0) {
        cPassword.style.borderColor = 'gray'
        cPassword.style.borderStyle = 'solid'
        cPassword.style.borderWidth = '0.025px'
        error_message.innerText =""
    }
}

/**
 * This function checks if the password, email address, and confirm password fields are valid.
 * @returns boolean
 */
function validateSignUp() {
    if (passwordRegex.test(password.value) && emailRegex.test(emailAddress.value) && confirmPassword) 
        return true
    else
        alert("Please fill out all fields correctly.")
        return false
}


password.addEventListener ("input", passwordValidation)
emailAddress.addEventListener("input", emailValidation)
cPassword.addEventListener("input", confirmPassword)

