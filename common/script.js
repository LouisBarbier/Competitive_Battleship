let loginElem = document.getElementById('login');

if (loginElem != undefined && loginElem != null) {
  loginElem.addEventListener('click',  function (event) {
    event.preventDefault();
  
    let height = 420;
    let width = 400;
  
    var top=((screen.height/2)-(height/2))/2;
    var left=(screen.width/2)-(width/2);
    var features = 'height='+height+',width='+width+',top='+top+',left='+left+',toolbar=1,Location=0,Directories=0,Status=0,menubar=1,Scrollbars=1,Resizable=1';
    
    window.open("login.php", "Log in - Competitive Battleship", features);
  });
}

function setUser (user) {
  // console.log(user);

  document.cookie = "user=" + JSON.stringify(user) + "; path=/";

  location.reload();
}

let bright_mode = document.getElementById('bright_mode');
let root = document.querySelector(':root');

if (bright_mode != undefined && bright_mode != null) {
  bright_mode.addEventListener('click',  function () {
    if (bright_mode.alt == "dark mode") {
      root.style.setProperty('--body-bg-color', '#3B3838');
      root.style.setProperty('--body-bg-color-hover', '#404040');
      root.style.setProperty('--nav-bg-color', '#787C7E');
      root.style.setProperty('--bd-color', 'white');
      root.style.setProperty('--tx-color', 'white');
      root.style.setProperty('--tx-color-inv', 'black');
      root.style.setProperty('--darker', 'rgba(255, 255, 255, 0.5)');
      root.style.setProperty('--small-darker', 'rgba(255, 255, 255, 0.1)');

      bright_mode.alt = "light mode";
      bright_mode.src = "./common/images/heavy-bulb.png";

      document.cookie = "dark_mode=1; path=/";
    } else {
      root.style.setProperty('--body-bg-color', '#e3e3e1');
      root.style.setProperty('--body-bg-color-hover', '#cacaca');
      root.style.setProperty('--nav-bg-color', '#787C7E');
      root.style.setProperty('--bd-color', 'black');
      root.style.setProperty('--tx-color', 'black');
      root.style.setProperty('--tx-color-inv', 'white');
      root.style.setProperty('--darker', 'rgba(0, 0, 0, 0.5)');
      root.style.setProperty('--small-darker', 'rgba(0, 0, 0, 0.1)');

      bright_mode.alt = "dark mode";
      bright_mode.src = "./common/images/light-bulb.png";

      document.cookie = "dark_mode=0; path=/";
    }
  });
}