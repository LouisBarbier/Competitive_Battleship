const url = "functions/checkLog.php";

document.getElementById('submit-but').addEventListener('click', function(){
    var fetchOptions = {
        method: "POST",
        headers: { 'Content-Type' : 'application/json' },
        body: JSON.stringify({
            id: document.getElementById('user_id').value,
            password: document.getElementById('password').value
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

            if (dataJSON.result.valid == '1') {
                window.opener.setUser(dataJSON.result.person);
                window.close();
            } else {
                document.getElementById("error-msg").style.display = 'block';
                document.getElementById("error-msg").style.visibility = 'visible';
            }
            
        })
        .catch((error) => console.log(error));
});