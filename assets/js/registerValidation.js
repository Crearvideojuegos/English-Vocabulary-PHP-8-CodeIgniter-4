const navLink = document.querySelectorAll('.nav-no-register');
const registerModal = bootstrap.Modal.getOrCreateInstance('#registerModal');

navLink.forEach(navLinkLogin => {

    navLinkLogin.addEventListener('click', function handleClick(event) {
        registerModal.show();

    });
});

document.querySelector('#register-modal-login').onclick = () => {

    registerModal.hide();
    const loginModal = bootstrap.Modal.getOrCreateInstance('#loginModal');
    loginModal.show();
}

document.querySelector('#register-nav').onclick = () => {
    registerModal.show();
}

/*Register Validation*/
const usernameEl = document.querySelector('#register_nickname');
const emailEl = document.querySelector('#register_email');
const passwordEl = document.querySelector('#register_password');
const confirmPasswordEl = document.querySelector('#register_password_two');

const form = document.querySelector('#register-form');

const checkUsername = () => {

    let valid = false;

    const min = 3,
        max = 40;

    const username = usernameEl.value.trim();

    if (!isRequired(username)) {
        showError(usernameEl, 'Username cannot be blank.');
        usernameEl.classList.add("error-input-border");

    } else if (!isBetween(username.length, min, max)) {
        usernameEl.classList.add("error-input-border");
        showError(usernameEl, `Username must be between ${min} and ${max} characters.`)
    } else {
        usernameEl.classList.remove("error-input-border");
        showSuccess(usernameEl);
        valid = true;
    }
    return valid;
};

const checkEmail = () => {
    let valid = false;
    const email = emailEl.value.trim();
    if (!isRequired(email)) {
        emailEl.classList.add("error-input-border");
        showError(emailEl, 'Email cannot be blank.');
    } else if (!isEmailValid(email)) {
        emailEl.classList.add("error-input-border");
        showError(emailEl, 'Email is not valid.')
    } else {
        emailEl.classList.remove("error-input-border");
        showSuccess(emailEl);
        valid = true;
    }
    return valid;
};

const checkPassword = () => {

    let valid = false;

    const password = passwordEl.value.trim();

    if (!isRequired(password)) {
        passwordEl.classList.add("error-input-border");
        showError(passwordEl, 'Password cannot be blank.');
    } else {
        passwordEl.classList.remove("error-input-border");
        showSuccess(passwordEl);
        valid = true;
    }

    return valid;
};

const checkConfirmPassword = () => {
    let valid = false;
    // check confirm password
    const confirmPassword = confirmPasswordEl.value.trim();
    const password = passwordEl.value.trim();

    if (!isRequired(confirmPassword)) {
        confirmPasswordEl.classList.add("error-input-border");
        showError(confirmPasswordEl, 'Please enter the password again');
    } else if (password !== confirmPassword) {
        confirmPasswordEl.classList.add("error-input-border");
        showError(confirmPasswordEl, 'The password does not match');
    } else {
        confirmPasswordEl.classList.remove("error-input-border");
        showSuccess(confirmPasswordEl);
        valid = true;
    }

    return valid;
};

const isEmailValid = (email) => {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};

const isPasswordSecure = (password) => {
    const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    return re.test(password);
};

const isRequired = value => value === '' ? false : true;
const isBetween = (length, min, max) => length < min || length > max ? false : true;




const showError = (input, message) => {
    // get the form-field element
    const formField = input.parentElement;
    // add the error class
    formField.classList.remove('success');
    formField.classList.add('error');

    // show the error message
    const error = formField.querySelector('small');
    error.textContent = message;
};

const showSuccess = (input) => {
    // get the form-field element
    const formField = input.parentElement;

    // remove the error class
    formField.classList.remove('error');
    formField.classList.add('success');

    // hide the error message
    const error = formField.querySelector('small');
    error.textContent = '';
}


form.addEventListener('submit', function (e) {
    // prevent the form from submitting
    e.preventDefault();


    // validate forms
    let isUsernameValid = checkUsername(),
        isEmailValid = checkEmail(),
        isPasswordValid = checkPassword(),
        isConfirmPasswordValid = checkConfirmPassword();

    let isFormValid = isUsernameValid &&
        isEmailValid &&
        isPasswordValid &&
        isConfirmPasswordValid;

    // submit to the server if the form is valid
    if (isFormValid) {
        form.submit()
    }
});


const debounce = (fn, delay = 500) => {
    let timeoutId;
    return (...args) => {
        // cancel the previous timer
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        // setup a new timer
        timeoutId = setTimeout(() => {
            fn.apply(null, args)
        }, delay);
    };
};

form.addEventListener('input', debounce(function (e) {
    switch (e.target.id) {
        case 'username':
            checkUsername();
            break;
        case 'email':
            checkEmail();
            break;
        case 'password':
            checkPassword();
            break;
        case 'confirm-password':
            checkConfirmPassword();
            break;
    }
}));