const elements=document.querySelectorAll('.et');

for(element of elements){
element.addEventListener("click",function(){
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
    document.dispatchEvent(new KeyboardEvent('keypress',{key:'s',ctrlKey:true}))
    console.log"Done")
}


