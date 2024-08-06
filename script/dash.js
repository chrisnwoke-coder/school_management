
/*slide down navigation bar on scroll*/
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  // When the user scrolls down 20px from the top of the document, slide down the navbar
// When the user scrolls to the top of the page, slide up the navbar (10px out of the top view)
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("navbar").style.top = "0";
    document.getElementById("navbar").style.backgroundColor = "#262F5A";
  } else {
    document.getElementById("navbar").style.top = "10px";
    document.getElementById("navbar").style.backgroundColor = "unset";
  }
} 


/*animate on scroll*/
AOS.init();



/*load more images*/
function myFunction() {
    var moreText = document.getElementById("course-info-hidden");
    var btnText = document.getElementById("myBtn");
  
    if(btnText.style.display === "none"){
      btnText.innerHTML = "Load more"; 
      moreText.style.display = "none";
    }else{
      btnText.style.display = "none"; 
      moreText.style.display = "flex";
    }
  }
