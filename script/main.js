console.log("hello world!");
var error1 = document.getElementsByClassName("error_1")[0];
var error2 = document.getElementsByClassName("error_1")[1];
var error_3 = document.getElementsByClassName("error_1")[2];
var error_4 = document.getElementsByClassName("error_1")[3];
var record = document.getElementsByClassName("message")[0];
var record_2 = document.getElementsByClassName("message")[1];
var success = document.getElementById("message");
 if(success!== null || success!== undefined){
  setTimeout(function(e){
     success.style.display = "none";
  },4000);
 }

if(error1!== null || error1!== undefined){
   setTimeout(function(e){
      error1.style.display = "none";
   },4000);
}

if(error2!== null || error2!== undefined){
   setTimeout(function(e){
      error2.style.display = "none";
   },4000);
}

if(error_3!== null || error3!== undefined){
   setTimeout(function(e){
      error_3.style.display = "none";
   },4000);

} 

if(error_4!== null || error4!== undefined){
   setTimeout(function(e){
      error_4.style.display = "none";
   },4000);

}

if(record!== null || record!== undefined){
   if(record !== null){
   setTimeout(function(e){
      record.style.display = "none";
   },4000);
   }
}

if(record_2!== null || record_2!== undefined){
   setTimeout(function(e){
      record_2.style.display = "none";
   },4000);
}