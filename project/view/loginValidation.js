function checkLoginForm() {
    let username = document.getElementById('username');
    let password = document.getElementById('password');
    let uError = document.getElementById('uError');
    let pError = document.getElementById('pError');

    let valid = true;

    if (username && username.value.trim() === "") {
        uError.style.color = "red";
        uError.innerHTML = "Please enter your username!";
        valid = false;
    } 
    else if (uError) {
        uError.innerHTML = "";
    }

    if (password && password.value.trim() === "") {
        pError.style.color = "red";
        pError.innerHTML = "Please enter your password!";
        valid = false;
    } 
    else if (pError) {
        pError.innerHTML = "";
    }

    return valid;
}


function checkRegisterForm() {
    let username = document.getElementById('reg_username');
    let email = document.getElementById('reg_email');
    let password = document.getElementById('reg_password');
    let confirm = document.getElementById('reg_confirm');

    let valid = true;

    if (username && username.value.trim().length < 3) 
    {
        alert("Username must be at least 3 characters long.");
        valid = false;
    }

    if (email && !/^[^@]+@[^@]+\.[^@]+$/.test(email.value)) 
    {
        alert("Invalid email format.");
        valid = false;
    }

    if (password && password.value.length < 6) {
        alert("Password must be at least 6 characters.");
        valid = false;
    }

    if (confirm && password && confirm.value !== password.value) {
        alert("Passwords do not match.");
        valid = false;
    }

    return valid;
}


function checkResetForm() {
    let password = document.getElementById('new_password');
    let confirm = document.getElementById('confirm_password');

    if (password && password.value.length < 6) {
        alert("Password must be at least 6 characters.");
        return false;
    }

    if (confirm && password && confirm.value !== password.value) {
        alert("Passwords do not match.");
        return false;
    }

    return true;
}
