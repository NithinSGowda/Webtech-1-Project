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

