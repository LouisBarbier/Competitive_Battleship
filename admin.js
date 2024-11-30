const users_list_elem = document.getElementById('users-list');
const template_user = document.getElementById('template-user').innerHTML.split('@');

// console.log(template_user);

var currently_loaded = document.querySelectorAll('.row>.col>.card').length;
var loaded = true;

// console.log(currently_loaded);

const url = "./functions/loadMore.php";

function add0Until (text, wantedLength) {
    return '0'.repeat(wantedLength - text.length) + text;
}

function addNewUser (user){
    let newUser = document.createElement('div');
    newUser.className = 'col mb-4';

    let newUserContent = "";
    for (user_part of template_user) {
        switch (user_part) {
            case 'pers_photo':
                if ((user.pers_photo != null) && (user.pers_photo != "")) {
                    newUserContent += user.pers_photo;
                } else {
                    newUserContent += "default.png";
                }
                break;
            case 'pers_username':
                newUserContent += user.pers_username;
                break;
            case 'pers_firstname':
                newUserContent += user.pers_firstname;
                break;
            case 'pers_lastname':
                newUserContent += user.pers_lastname;
                break;
            case 'pers_email':
                newUserContent += user.pers_email;
                break;
            case 'pers_datecre':
                let datecre = new Date(user.pers_datecre);
                newUserContent += add0Until((datecre.getMonth()+1).toString(), 2) + '/' + add0Until(datecre.getDate().toString(), 2) + '/' + datecre.getFullYear() + ' ' + add0Until(datecre.getHours().toString(), 2) + ':' + add0Until(datecre.getMinutes().toString(), 2) + ':' + add0Until(datecre.getSeconds().toString(), 2);
                break;
            case 'pers_score':
                newUserContent += user.pers_score;
                break;
            case 'pers_nbbattle':
                newUserContent += user.pers_nbbattle;
                break;
            default:
                newUserContent += user_part;
        }
    }

    newUser.innerHTML = newUserContent;

    users_list_elem.appendChild(newUser);

    currently_loaded++;
}

function loadMore () {
    console.log('loading more');

	var fetchOptions = {
		method: "POST",
		headers: { 'Content-Type' : 'application/json' },
		body: JSON.stringify({ offset: currently_loaded})
	};
	
	// console.log(fetchOptions);

	fetch (url, fetchOptions)
		.then((response) => {
			// console.log(response);
			return response.json();
		})
		.then((dataJSON) => {
			
            dataJSON.results.forEach((user) => addNewUser(user));
			
		})
		.catch((error) => console.log(error))
        .finally(() => {
            loaded = true;
        });
}

window.addEventListener('scroll',()=>{
    const {scrollTop,clientHeight,scrollHeight} = document.documentElement;
    if ((scrollTop+clientHeight)>=scrollHeight && loaded) {
        loaded = false;
        loadMore();
    }
});