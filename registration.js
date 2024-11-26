const url_username = "functions/checkUsername.php";
const url_email = "functions/checkEmail.php";

const usernameElem = document.getElementById('username');
const emailElem = document.getElementById('email');
const passwordElem = document.getElementById('password');
const confirmElem = document.getElementById('confirm-password');

const usernameStatus = document.getElementById("usernameTaken");
const emailStatus = document.getElementById("emailTaken");

var timerUsername = null;
var timerEmail = null;
var timerPassword = null;

// Check if someone already has this username
function checkUsername () {
    if (usernameElem.value == "" || usernameElem.value == null) {
        usernameElem.classList.remove("is-invalid");
        usernameStatus.textContent = "No username";
        usernameStatus.classList.remove("red");
        usernameStatus.classList.remove("green");
    } else {
        var fetchOptions = {
            method: "POST",
            headers: { 'Content-Type' : 'application/json' },
            body: JSON.stringify({
                username: usernameElem.value
            })
        };
            
        // console.log(fetchOptions);
    
        fetch (url_username, fetchOptions)
            .then((response) => {
                // console.log(response);
                return response.json();
            })
            .then((dataJSON) => {
                // console.log(dataJSON);

                document.getElementById('username-valid').value = dataJSON.result.exist !== '1';
    
                if (dataJSON.result.exist == '1') {
                    usernameStatus.textContent = "Already taken";
                    usernameStatus.classList.remove("green");
                    usernameStatus.classList.add("red");
                    usernameElem.classList.add("is-invalid");
                } else {
                    usernameStatus.textContent = "Username free";
                    usernameStatus.classList.remove("red");
                    usernameStatus.classList.add("green");
                    usernameElem.classList.remove("is-invalid");
                }
                
            })
            .catch((error) => console.log(error));
    }

    timerUsername = null;
}

usernameElem.addEventListener('keyup', function(){
    if (timerUsername == null) {
        timerUsername = setTimeout(checkUsername, 1000);
    }
    else {
        window.clearTimeout(timerUsername);
        timerUsername = setTimeout(checkUsername, 1000);
    }
});
usernameElem.addEventListener('change', function(){
    if (timerUsername == null) {
        timerUsername = setTimeout(checkUsername, 1000);
    }
    else {
        window.clearTimeout(timerUsername);
        timerUsername = setTimeout(checkUsername, 1000);
    }
});

// Check if someone already has this email
function checkEmail () {
    if (emailElem.value == "" || emailElem.value == null) {
        emailStatus.textContent = "No email";
        emailStatus.classList.remove("red");
        emailStatus.classList.remove("green");
        emailElem.classList.remove("is-invalid");
    } else {
        var fetchOptions = {
            method: "POST",
            headers: { 'Content-Type' : 'application/json' },
            body: JSON.stringify({
                email: emailElem.value
            })
        };
            
        console.log(fetchOptions);
    
        fetch (url_email, fetchOptions)
            .then((response) => {
                // console.log(response);
                return response.json();
            })
            .then((dataJSON) => {
                // console.log(dataJSON);

                document.getElementById('email-valid').value = dataJSON.result.exist !== '1';
    
                if (dataJSON.result.exist == '1') {
                    emailStatus.textContent = "Email already used";
                    emailStatus.classList.remove("green");
                    emailStatus.classList.add("red");
                    emailElem.classList.add("is-invalid");
                } else {
                    emailStatus.textContent = "Username free";
                    emailStatus.classList.remove("red");
                    emailStatus.classList.add("green");
                    emailElem.classList.remove("is-invalid");
                }
                
            })
            .catch((error) => console.log(error));
    }

    timerEmail = null;
}

emailElem.addEventListener('keyup', function(){
    if (timerEmail == null) {
        timerEmail = setTimeout(checkEmail, 1000);
    }
    else {
        window.clearTimeout(timerUsername);
        timerEmail = setTimeout(checkEmail, 1000);
    }
});
emailElem.addEventListener('change', function(){
    if (timerEmail == null) {
        timerEmail = setTimeout(checkEmail, 1000);
    }
    else {
        window.clearTimeout(timerUsername);
        timerEmail = setTimeout(checkEmail, 1000);
    }
});


// Place the input profile-picture into the image
function changeProfilePicture () {
    let file = document.getElementById('profile-picture').files[0];

    if (file) {
        document.getElementById('profile-picture-visualizer').src = URL.createObjectURL(file)
        document.getElementById('profile-picture-visualizer').addEventListener('onLoad', function(){
            URL.revokeObjectURL(document.getElementById('profile-picture-visualizer').src);
        });
    }
}

document.getElementById('profile-picture').addEventListener('change', changeProfilePicture);


// Check if the passwords are the same
function checkPasswords () {
    document.getElementById('password-valid').value = (passwordElem.value != "" && confirmElem.value != "" && passwordElem.value == confirmElem.value);

    if (passwordElem.value != "" && confirmElem.value != "" && passwordElem.value != confirmElem.value) {
        confirmElem.classList.add("is-invalid");
    } else {
        confirmElem.classList.remove("is-invalid");
    }

    timerPassword = null;
}

passwordElem.addEventListener('keyup', function () {
    if (timerPassword == null) {
        timerPassword = setTimeout(checkPasswords, 1000);
    }
    else {
        window.clearTimeout(timerPassword);
        timerPassword = setTimeout(checkPasswords, 1000);
    }
});
passwordElem.addEventListener('change', function () {
    if (timerPassword == null) {
        timerPassword = setTimeout(checkPasswords, 1000);
    }
    else {
        window.clearTimeout(timerPassword);
        timerPassword = setTimeout(checkPasswords, 1000);
    }
});
confirmElem.addEventListener('keyup', function () {
    if (timerPassword == null) {
        timerPassword = setTimeout(checkPasswords, 1000);
    }
    else {
        window.clearTimeout(timerPassword);
        timerPassword = setTimeout(checkPasswords, 1000);
    }
});
confirmElem.addEventListener('change', function () {
    if (timerPassword == null) {
        timerPassword = setTimeout(checkPasswords, 1000);
    }
    else {
        window.clearTimeout(timerPassword);
        timerPassword = setTimeout(checkPasswords, 1000);
    }
});


// Check the form one last time before submitting
document.getElementById('registration-form').addEventListener('submit', function(event){
    // event.preventDefault();
    if (document.getElementById('username-valid').value !== "true") {
        usernameElem.focus();
        event.preventDefault();
    } else if (document.getElementById('email-valid').value !== "true") {
        emailElem.focus();
        event.preventDefault();
    } else if (document.getElementById('password-valid').value !== "true") {
        confirmElem.focus();
        event.preventDefault();
    }
});


window.onload = function () {
    checkUsername();
    checkPasswords();
    changeProfilePicture();
};
