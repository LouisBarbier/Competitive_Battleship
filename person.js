const url_username = "functions/checkUsername.php";
const url_email = "functions/checkEmail.php";

const usernameElem = document.getElementById('username');
const emailElem = document.getElementById('email');

const originalUsername = usernameElem.value;
const originalEmail = emailElem.value;

const usernameStatus = document.getElementById("usernameTaken");
const emailStatus = document.getElementById("emailTaken");

var timerUsername = null;
var timerEmail = null;

// Check if someone already has this username
function checkUsername () {
    if (usernameElem.value == "" || usernameElem.value == null) {
        document.getElementById('username-valid').value = false;
        usernameElem.classList.remove("is-invalid");
        usernameStatus.textContent = "No username";
        usernameStatus.classList.remove("red");
        usernameStatus.classList.remove("green");
    } else if (usernameElem.value == originalUsername) {
        document.getElementById('username-valid').value = true;
        usernameStatus.textContent = "Username free";
        usernameStatus.classList.remove("red");
        usernameStatus.classList.add("green");
        usernameElem.classList.remove("is-invalid");
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
        document.getElementById('email-valid').value = false;
        emailStatus.textContent = "No email";
        emailStatus.classList.remove("red");
        emailStatus.classList.remove("green");
        emailElem.classList.remove("is-invalid");
    } else if (emailElem.value == originalEmail) {
        document.getElementById('email-valid').value = true;
        emailStatus.textContent = "Email free";
        emailStatus.classList.remove("red");
        emailStatus.classList.add("green");
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
                    emailStatus.textContent = "Email free";
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


// Check the form one last time before submitting
document.getElementById('modification-form').addEventListener('submit', function(event){
    // event.preventDefault();
    if (document.getElementById('delete-user').value == 0) {
        if (document.getElementById('username-valid').value !== "true") {
            usernameElem.focus();
            event.preventDefault();
        } else if (document.getElementById('email-valid').value !== "true") {
            emailElem.focus();
            event.preventDefault();
        }
    }
});

document.getElementById('delete-but').addEventListener('click', function(){
    if (confirm("Are you sure you want to delete " + originalUsername + "'s account ?")) {
        document.getElementById('delete-user').value = 1;
        document.getElementById('modification-form').submit();
    }
});

window.onload = function () {
    checkUsername();
    checkEmail();
    changeProfilePicture();
};
