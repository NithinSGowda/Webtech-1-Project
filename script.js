const elements=document.querySelectorAll('.et');

for(element of elements){
element.addEventListener("dblclick",function(){
    const editedText=prompt("Enter the Heading");
    this.innerHTML=editedText;
});}
const chngbtn = document.querySelector('.change');
const blueArea = document.querySelector('.blue');
function changeColor(){
    var clr1=document.querySelector('.picker1').value;
    var clr2=document.querySelector('.picker2').value;
    blueArea.style.backgroundImage = 'linear-gradient(50deg,' + clr1 + ', ' + clr2 + ' 100%)';
}

function dl(){
    document.body.style.backgroundColor = "Black";
    document.body.style.color = "white";
    document.querySelectorAll('.c1')[0].style.backgroundColor='Black';
    document.querySelectorAll('.c1')[0].style.border='1px solid white';

    document.querySelectorAll('.c1')[1].style.backgroundColor='Black';
    document.querySelectorAll('.c1')[1].style.border='1px solid white';

    document.querySelectorAll('.c1')[2].style.backgroundColor='Black';
    document.querySelectorAll('.c1')[2].style.border='1px solid white';

    document.querySelector('.blue').style.backgroundImage='linear-gradient(50deg,#0d0d0d 0,#000000 100%)'
}
function download(e){
  document.querySelector('.downloader').style.display = 'flex';
}

function remover(e){
document.querySelector('.downloader').style.display = 'none';
const colors = document.querySelectorAll('.colorChanger');
for(col of colors)
{
  col.style.display = 'none';
}
document.querySelector('.dark').style.display='none';
document.querySelector('.a5').style.display='none';
document.querySelector('.a4').style.display='none';


document.querySelector('.jss').innerHTML=' ';

}



for(element of elements)
{dragElement(element);}







function dragElement(elmnt) {
  
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id)) {
    /* if present, the header is where you move the DIV from:*/
    document.getElementById(elmnt.id).onmousedown = dragMouseDown;
  } else {
    /* otherwise, move the DIV from anywhere inside the DIV:*/
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    elmnt.style.position="absolute";
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}

var tutorialCookie = document.cookie;
if(tutorialCookie.includes("tutorial=done")){
  console.log(tutorialCookie);
  document.querySelector('.tutorial').style.display='none';
}



function nxt1(){
  butn=document.querySelector('.tt1')
  butn.style.display='none';
  butn=document.querySelector('.tt2')
  butn.style.display='block';
  console.log("Done")
}
function nxt2(){
  butn=document.querySelector('.tt2')
  butn.style.display='none';
  butn=document.querySelector('.tt3')
  butn.style.display='block';
  console.log("Done")
}
function nxt3(){
  butn=document.querySelector('.tt3')
  butn.style.display='none';
  butn=document.querySelector('.tutorial')
  butn.style.display='none';
  console.log("Done");
  var d = new Date();
    d.setTime(d.getTime() + (30*24*60*60*1000));
document.cookie = "tutorial=done; expires=" + d.toUTCString();
}


function login(){
  document.querySelector('.existinglogin').style.display='flex';
  document.querySelector('.login-form').style.display='none';
}


function register(){
  document.querySelector('.existinglogin').style.display='none';
  document.querySelector('.login-form').style.display='flex';
}