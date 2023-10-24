const loginModal = bootstrap.Modal.getOrCreateInstance('#loginModal');

document.querySelector('#login-nav').onclick = () => {
    loginModal.show();
}

/*Login Validation*/

const emailElLogin = document.querySelector('#login_email');
const passwordElLogin = document.querySelector('#login_password');

const formLogin = document.querySelector('#login-form');

const checkEmailLogin = () => {
    let valid = false;
    const email = emailElLogin.value.trim();
    if (!isRequiredLogin(email)) {
        showErrorLogin(emailElLogin, 'Email cannot be blank.');
        document.querySelector('#login_email').classList.add("error-input-border");
    } else if (!isEmailValidLogin(email)) {
        showErrorLogin(emailElLogin, 'Email is not valid.')
    } else {
        document.querySelector('#login_email').classList.remove("error-input-border");
        sshowSuccessLogin(emailElLogin);
        valid = true;
    }
    return valid;
};

const checkPasswordLogin = () => {

    let valid = false;

    const password = passwordElLogin.value.trim();

    if (!isRequiredLogin(password)) {
        showErrorLogin(passwordElLogin, 'Password cannot be blank.');
        document.querySelector('#login_password').classList.add("error-input-border");
    } else {
        document.querySelector('#login_password').classList.remove("error-input-border");
        sshowSuccessLogin(passwordElLogin);
        valid = true;
    }

    return valid;
};


const isEmailValidLogin = (email) => {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};

const isPasswordSecureLogin = (password) => {
    const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    return re.test(password);
};

const isRequiredLogin = value => value === '' ? false : true;
const isBetweenLogin = (length, min, max) => length < min || length > max ? false : true;


const showErrorLogin = (input, message) => {
    // get the form-field element
    const formField = input.parentElement;
    // add the error class
    formField.classList.remove('success');
    formField.classList.add('error');

    // show the error message
    const error = formField.querySelector('small');
    error.textContent = message;
};

const sshowSuccessLogin = (input) => {
    // get the form-field element
    const formField = input.parentElement;

    // remove the error class
    formField.classList.remove('error');
    formField.classList.add('success');

    // hide the error message
    const error = formField.querySelector('small');
    error.textContent = '';
}


formLogin.addEventListener('submit', function (e) {
    // prevent the form from submitting
    e.preventDefault();


    // validate forms
    let isEmailValidLogin = checkEmailLogin(),
        isPasswordValid = checkPasswordLogin();

    let isFormValid = isEmailValidLogin &&
                      isPasswordValid;

    // submit to the server if the form is valid
    if (isFormValid) {
        formLogin.submit()
    }
});


const debounceLogin = (fn, delay = 500) => {
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


formLogin.addEventListener('input', debounceLogin(function (e) {
    switch (e.target.id) {
        case 'email':
            checkEmailLogin();
            break;
        case 'password':
            checkPasswordLoginLogin();
            break;
    }
}));