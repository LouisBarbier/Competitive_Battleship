const url = 'functions/lookForPlayer.php';
const url_stop = 'functions/stopLookForPlayer.php';

const pers_id = document.getElementById('pers_id').value;
const pers_score = parseInt(document.getElementById('pers_score').value);

const rankMinElem = document.getElementById('rankMin');
const rankMaxElem = document.getElementById('rankMax');

var rankMin = pers_score - 10;
var rankMax = pers_score + 10;

if (rankMin < 0) {
    rankMin = 0;
}

// Look for other players that are searching a battle
function lookForPlayer () {
    rankMinElem.textContent = rankMin;
    rankMaxElem.textContent = rankMax;

    var fetchOptions = {
        method: "POST",
        headers: { 'Content-Type' : 'application/json' },
        body: JSON.stringify({
            id: pers_id,
            rank_min: rankMin,
            rank_max: rankMax
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

            // Player found => We start the battle
            if (dataJSON.result.found === '1') {
                if (dataJSON.result.battle !== '-1') {
                    interval = null;
                    window.location.href = "battle.php?id=" + dataJSON.result.battle;
                }
            }
            // No player found => We increase the rank range
            else {
                rankMin -= 10;
                rankMax += 10;

                if (rankMin < 0) {
                    rankMin = 0;
                }
            }
            
        })
        .catch((error) => console.log(error));
}

// Remove the user from the pool of users looking for a battle before leaving the matchmaking page
window.addEventListener("beforeunload", function (event) {
    interval = null;

    var fetchOptions = {
        method: "POST",
        headers: { 'Content-Type' : 'application/json' },
        body: JSON.stringify({
            id: pers_id
        })
    };
        
    // console.log(fetchOptions);

    fetch (url_stop, fetchOptions)
        .then((response) => {
            console.log(response);
        })
        .catch((error) => {
            event.preventDefault();
            console.log(error);
        });
});

var interval = null;

window.onload = function () {
    lookForPlayer();
    
    interval = setInterval(lookForPlayer, 10000);
};