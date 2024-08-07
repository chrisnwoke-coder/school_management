
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

/*purecounter*/

new PureCounter({
  // Setting that can't' be overriden on pre-element
  selector: ".purecounter-1", // HTML query selector for spesific element

  // Settings that can be overridden on per-element basis, by `data-purecounter-*` attributes:
  start: 0, // Starting number [uint]
  end: 540, // End number [uint]
  duration: 2, // The time in seconds for the animation to complete [seconds]
  delay: 5, // The delay between each iteration (the default of 10 will produce 100 fps) [miliseconds]
  once: true, // Counting at once or recount when the element in view [boolean]
  pulse: false, // Repeat count for certain time [boolean:false|seconds]
  decimals: 0, // How many decimal places to show. [uint]
  legacy: true, // If this is true it will use the scroll event listener on browsers
  filesizing: false, // This will enable/disable File Size format [boolean]
  currency: false, // This will enable/disable Currency format. Use it for set the symbol too [boolean|char|string]
  formater: "us-US", // Number toLocaleString locale/formater, by default is "en-US" [string|boolean:false]
  separator: false // This will enable/disable comma separator for thousands. Use it for set the symbol too [boolean|char|string]
});

new PureCounter({
  // Setting that can't' be overriden on pre-element
  selector: ".purecounter-2", // HTML query selector for spesific element

  // Settings that can be overridden on per-element basis, by `data-purecounter-*` attributes:
  start: 0, // Starting number [uint]
  end: 320, // End number [uint]
  duration: 2, // The time in seconds for the animation to complete [seconds]
  delay: 5, // The delay between each iteration (the default of 10 will produce 100 fps) [miliseconds]
  once: true, // Counting at once or recount when the element in view [boolean]
  pulse: false, // Repeat count for certain time [boolean:false|seconds]
  decimals: 0, // How many decimal places to show. [uint]
  legacy: true, // If this is true it will use the scroll event listener on browsers
  filesizing: false, // This will enable/disable File Size format [boolean]
  currency: false, // This will enable/disable Currency format. Use it for set the symbol too [boolean|char|string]
  formater: "us-US", // Number toLocaleString locale/formater, by default is "en-US" [string|boolean:false]
  separator: false // This will enable/disable comma separator for thousands. Use it for set the symbol too [boolean|char|string]
});

new PureCounter({
  // Setting that can't' be overriden on pre-element
  selector: ".purecounter-3", // HTML query selector for spesific element

  // Settings that can be overridden on per-element basis, by `data-purecounter-*` attributes:
  start: 0, // Starting number [uint]
  end: 1000, // End number [uint]
  duration: 2, // The time in seconds for the animation to complete [seconds]
  delay: 5, // The delay between each iteration (the default of 10 will produce 100 fps) [miliseconds]
  once: true, // Counting at once or recount when the element in view [boolean]
  pulse: false, // Repeat count for certain time [boolean:false|seconds]
  decimals: 0, // How many decimal places to show. [uint]
  legacy: true, // If this is true it will use the scroll event listener on browsers
  filesizing: false, // This will enable/disable File Size format [boolean]
  currency: false, // This will enable/disable Currency format. Use it for set the symbol too [boolean|char|string]
  formater: "us-US", // Number toLocaleString locale/formater, by default is "en-US" [string|boolean:false]
  separator: false // This will enable/disable comma separator for thousands. Use it for set the symbol too [boolean|char|string]
});

new PureCounter({
  // Setting that can't' be overriden on pre-element
  selector: ".purecounter-4", // HTML query selector for spesific element

  // Settings that can be overridden on per-element basis, by `data-purecounter-*` attributes:
  start: 0, // Starting number [uint]
  end: 587, // End number [uint]
  duration: 2, // The time in seconds for the animation to complete [seconds]
  delay: 5, // The delay between each iteration (the default of 10 will produce 100 fps) [miliseconds]
  once: true, // Counting at once or recount when the element in view [boolean]
  pulse: false, // Repeat count for certain time [boolean:false|seconds]
  decimals: 0, // How many decimal places to show. [uint]
  legacy: true, // If this is true it will use the scroll event listener on browsers
  filesizing: false, // This will enable/disable File Size format [boolean]
  currency: false, // This will enable/disable Currency format. Use it for set the symbol too [boolean|char|string]
  formater: "us-US", // Number toLocaleString locale/formater, by default is "en-US" [string|boolean:false]
  separator: false // This will enable/disable comma separator for thousands. Use it for set the symbol too [boolean|char|string]
});