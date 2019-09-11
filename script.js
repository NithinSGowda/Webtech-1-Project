const elements=document.querySelectorAll('.ET');

for(element of elements){
element.addEventListener("click",function(){
    const editedText=prompt("Enter the value");
    this.innerHTML=editedText;
    });}




