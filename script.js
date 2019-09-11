const elements=document.querySelectorAll('.Ee');

for(element of elements){
element.addEventListener("click",function(){
    const editedText=prompt("Enter the Heading");
    this.innerHTML=editedText;
});}




