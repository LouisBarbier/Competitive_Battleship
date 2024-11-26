const url = "functions/checkUsername.php";

function checkUsername () {
    if (document.getElementById('username').value == "" || document.getElementById('username').value == null) {
        document.getElementById("taken").textContent = "No username";
        document.getElementById("taken").classList.remove("red");
        document.getElementById("taken").classList.remove("green");
    } else {
        var fetchOptions = {
            method: "POST",
            headers: { 'Content-Type' : 'application/json' },
            body: JSON.stringify({
                username: document.getElementById('username').value
            })
        };
            
        // console.log(fetchOptions);
    
        fetch (url, fetchOptions)
            .then((response) => {
                // console.log(response);
                return response.json();
            })
            .then((dataJSON) => {
                // console.log(dataJSON);

                document.getElementById('username-valid').value = dataJSON.result.exist == '1';
    
                if (dataJSON.result.exist == '1') {
                    document.getElementById("taken").textContent = "Already taken";
                    document.getElementById("taken").classList.remove("green");
                    document.getElementById("taken").classList.add("red");
                } else {
                    document.getElementById("taken").textContent = "Username free";
                    document.getElementById("taken").classList.remove("red");
                    document.getElementById("taken").classList.add("green");
                }
                
            })
            .catch((error) => console.log(error));
    }

    timer = null;
}

var timer = null;

// Check if someone already has this username
document.getElementById('username').addEventListener('keyup', function(){
    if (timer == null) {
        timer = setTimeout(checkUsername, 1000);
    }
    else {
        window.clearTimeout(timer);
        timer = setTimeout(checkUsername, 1000);
    }
});

// Place the input profile-picture into the image
document.getElementById('profile-picture').addEventListener('change', function(){
    let file = document.getElementById('profile-picture').files[0];

    if (file) {
        document.getElementById('profile-picture-visualizer').src = URL.createObjectURL(file)
        document.getElementById('profile-picture-visualizer').addEventListener('onLoad', function(){
            URL.revokeObjectURL(document.getElementById('profile-picture-visualizer').src);
        });
    }
});

// Check if the passwords are the same
function checkPasswords () {
    if (document.getElementById('password').value != "" && document.getElementById('confirm-password').value != "" && document.getElementById('password').value != document.getElementById('confirm-password').value) {
        document.getElementById('confirm-password').classList.add("is-invalid");
    } else {
        document.getElementById('confirm-password').classList.remove("is-invalid");
    }
}

document.getElementById('password').addEventListener('change', checkPasswords);
document.getElementById('confirm-password').addEventListener('change', checkPasswords);


// Check the form one last time before submitting
document.getElementById('registration-form').addEventListener('submit', function(event){
    event.preventDefault();
    if (document.getElementById('username-valid').value !== "1") {
        document.getElementById('username').focus();
        event.preventDefault();
    } else if (document.getElementById('password-valid').value !== "1") {
        document.getElementById('confirm-password').focus();
        event.preventDefault();
    }
});
