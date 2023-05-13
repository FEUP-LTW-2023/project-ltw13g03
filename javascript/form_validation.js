function validateLogin(event) {
    const usernameInput = document.querySelector('input[name="username"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const usernameError = document.querySelector('input[name="username"] + .error');
    const passwordError = document.querySelector('input[name="password"] + .error');

    let isValid = true;

    // Check username
    if (usernameInput.value.trim() === '') {
        usernameError.textContent = 'Please enter a username.';
        isValid = false;
    } else {
        usernameError.textContent = '';
    }

    // Check password
    if (passwordInput.value.trim() === '') {
        passwordError.textContent = 'Please enter a password.';
        isValid = false;
    } else {
        passwordError.textContent = '';
    }

    if (!isValid) {
        event.preventDefault();
    }
}

function validateRegister(event) {
    const nameInput = document.querySelector('input[name="name"]');
    const usernameInput = document.querySelector('input[name="username"]');
    const emailInput = document.querySelector('input[name="email"]');
    const password1Input = document.querySelector('input[name="password1"]');
    const password2Input = document.querySelector('input[name="password2"]');
    const nameError = document.querySelector('input[name="name"] + .error');
    const usernameError = document.querySelector('input[name="username"] + .error');
    const emailError = document.querySelector('input[name="email"] + .error');
    const password1Error = document.querySelector('input[name="password1"] + .error');
    const password2Error = document.querySelector('input[name="password2"] + .error');

    let isValid = true;

    // Check name
    if (nameInput.value.trim() === '') {
        nameError.textContent = 'Please enter a name.';
        isValid = false;
    } else {
        nameError.textContent = '';
    }

    // Check username
    if (usernameInput.value.trim() === '') {
        usernameError.textContent = 'Please enter a username.';
        isValid = false;
    } else {
        usernameError.textContent = '';
    }

    // Check email
    if (emailInput.value.trim() === '') {
        emailError.textContent = 'Please enter an email address.';
        isValid = false;
    } else if (!emailInput.checkValidity()) {
        emailError.textContent = 'Please enter a valid email address.';
        isValid = false;
    } else {
        emailError.textContent = '';
    }

    // Check password
    if (password1Input.value.trim() === '') {
        password1Error.textContent = 'Please enter a password.';
        isValid = false;
    } else {
        password1Error.textContent = '';
    }

    if (password2Input.value.trim() === '') {
        password2Error.textContent = 'Please confirm your password.';
        isValid = false;
    } else if (password1Input.value !== password2Input.value) {
        password2Error.textContent = 'The passwords do not match.';
        isValid = false;
    } else {
        password2Error.textContent = '';
    }

    if (!isValid) {
        event.preventDefault();
    }
}

const loginForm = document.querySelector('section#login form');
const registerForm = document.querySelector('section#register form');

if(loginForm != null) {
    loginForm.addEventListener('submit', validateLogin);
}
if(registerForm != null) {
    registerForm.addEventListener('submit', validateRegister);
}