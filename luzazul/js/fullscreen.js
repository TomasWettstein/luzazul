let foto = document.getElementsByClassName('-full-screen');
function getFullscreen(element){
    if(element.requestFullscreen) {
        element.requestFullscreen();
      } else if(element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
      } else if(element.webkitRequestFullscreen) {
        element.webkitRequestFullscreen();
      } else if(element.msRequestFullscreen) {
        element.msRequestFullscreen();
      }

}
for (let i = 0; i <= foto.length; i++) {
  if (typeof foto[i] !== "undefined") {
    foto[i].addEventListener('click', function(event){
      event.preventDefault();
      getFullscreen(this);
    }, false);
  }
}
