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