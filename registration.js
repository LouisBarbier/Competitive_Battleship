const url = "functions/checkUsername.php";

document.getElementById('username').addEventListener('change', function(){
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
    
                if (dataJSON.result.valid == '1') {
                    document.getElementById("taken").textContent = "Username free";
                    document.getElementById("taken").classList.remove("red");
                    document.getElementById("taken").classList.add("green");
                } else {
                    document.getElementById("taken").textContent = "Already taken";
                    document.getElementById("taken").classList.remove("green");
                    document.getElementById("taken").classList.add("red");
                }
                
            })
            .catch((error) => console.log(error));
    }
});