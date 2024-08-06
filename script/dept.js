console.log("welcome!");
function togglePasswordVisibilty(){
   var passwordField = document.getElementById("passwordField");
   if(passwordField.type === "password"){
      passwordField.type = "text";
   }else{
      passwordField.type = "password";
   }
}
var success = document.getElementById('msg');
setTimeout(function(e){
   success.style.display = "none";
},4000);

var error1 = document.getElementsByClassName("error_1")[0];
 setTimeout(function(e){
    error1.style.display = "none";
 },4000);

 var error2 = document.getElementsByClassName("error_1")[1];
 setTimeout(function(e){
    error2.style.display = "none";
 },4000);



 var record = document.getElementsByClassName('message');
 var container = document.getElementsByClassName('container');
       setTimeout(function(e){
          if(record.textContent == ""){
            window.addEventListener('load', () =>{
             record.remove();
          });
       }
    },4000);
    
 var error1 = document.getElementsByClassName('error_1');
 error1 = function onLoad(){
    if(error1.value == error1.innerHTML){
       setTimeout(function(e){
          error1.style.display = "none";
       },4000);
    }else if(error1.value == ""){
        setTimeout(function(e){
            error1.style.display = "none";
        },1000);
    }
 }