document.getElementById('login').addEventListener('click',  function (event) {
  event.preventDefault();

  let height = 420;
  let width = 400;

  var top=((screen.height/2)-(height/2))/2;
  var left=(screen.width/2)-(width/2);
  var features = 'height='+height+',width='+width+',top='+top+',left='+left+',toolbar=1,Location=0,Directories=0,Status=0,menubar=1,Scrollbars=1,Resizable=1';
  
  window.open("login.html", "Log in - Competitive Battleship", features);
});