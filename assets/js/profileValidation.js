const passwordEl = document.querySelector('#password_profile');
const confirmPasswordEl = document.querySelector('#password_profile_two');
const oldPasswordEl = document.querySelector('#actual_password_profile');

const form = document.querySelector('#password-form');

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

const checkOldPassword = () => {

    let valid = false;

    const oldPassword = oldPasswordEl.value.trim();

    if (!isRequired(oldPassword)) {
        oldPasswordEl.classList.add("error-input-border");
        showError(oldPasswordEl, 'Password cannot be blank.');
    } else {
        oldPasswordEl.classList.remove("error-input-border");
        showSuccess(oldPasswordEl);
        valid = true;
    }

    return valid;
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
    let isPasswordValid = checkPassword(),
        isConfirmPasswordValid = checkConfirmPassword(),
        isOldPassword = checkOldPassword();

    let isFormValid = 
        isPasswordValid &&
        isOldPassword &&
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
        case 'password':
            checkPassword();
            break;
        case 'confirm-password':
            checkConfirmPassword();
            break;
    }
}));