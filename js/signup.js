function checkNome(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.name] = input.value.length > 0) {
        input.parentNode.parentNode.classList.remove('errorj');
        document.querySelector('#nome_span').classList.remove('visible');
    } else {
        input.parentNode.parentNode.classList.add('errorj');
        document.querySelector('#nome_span').classList.add('visible');
    }
}

function checkCognome(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.name] = input.value.length > 0) {
        input.parentNode.parentNode.classList.remove('errorj');
        document.querySelector('#cognome_span').classList.remove('visible');
    } else {
        input.parentNode.parentNode.classList.add('errorj');
        document.querySelector('#cognome_span').classList.add('visible');
    }
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function jsonCheckUsername(json) {
    if (formStatus.username = !json.exists) {
        document.querySelector('.username').classList.remove('errorj');
        document.querySelector('#username_span').classList.remove('visible');
    } else {
        document.querySelector('.username').classList.add('errorj');
        document.querySelector('#username_span').classList.add('visible');
    }
}

function checkUsername(event) {
    const input = document.querySelector('.username');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        input.parentNode.parentNode.querySelector('#username_span').classList.add('visible');
        input.parentNode.parentNode.classList.add('errorj');
        formStatus.username = false;
    } else {
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
    }    
}

function jsonCheckEmail(json) {
    if (formStatus.email = !json) {
        document.querySelector('.email').classList.remove('errorj');
        document.querySelector('#email_span').classList.remove('visible');
    } else {
        document.querySelector('#email_span').classList.add('visible');
        document.querySelector('.email').classList.add('errorj');
        console.log('ho aggiunto il rosso');
    }
}

function checkEmail(event) {
    const emailInput = document.querySelector('.email');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('#email_span').classList.add('visible');
        document.querySelector('.email').classList.add('errorj');
        formStatus.email = false;
    } else {
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

function checkPassword(event) {
    const passwordInput = document.querySelector('.password');
    if (formStatus.password = passwordInput.value.length >= 8) {
        document.querySelector('.password').classList.remove('errorj');
        document.querySelector('#password_span').classList.remove('visible');
    } else {
        document.querySelector('.password').classList.add('errorj');
        document.querySelector('#password_span').classList.add('visible'); 
        console.log('ho aggiunto il rosso');
    }   
}

function checkConfirmPassword(event) {
    const confirmPasswordInput = document.querySelector('.confirm_password');
    if (formStatus.confirmPassord = confirmPasswordInput.value === document.querySelector('.password').value) {
        document.querySelector('.confirm_password').classList.remove('errorj');
        document.querySelector('#confirm_password_span').classList.remove('visible');
    } else{
        document.querySelector('.confirm_password').classList.add('errorj');
        document.querySelector('#confirm_password_span').classList.add('visible');
        console.log("ho aggiunto il rosso");
    }
}

const formStatus = {'upload': true};
document.querySelector('.nome').addEventListener('blur', checkNome);
document.querySelector('.cognome').addEventListener('blur', checkCognome);
document.querySelector('.username').addEventListener('blur', checkUsername);
document.querySelector('.email').addEventListener('blur', checkEmail);
document.querySelector('.password').addEventListener('blur', checkPassword);
document.querySelector('.confirm_password').addEventListener('blur', checkConfirmPassword);

