
//calculate height of mobile nav and create "menu-open class"
let mobileNavHeight = $('#mobileWrapper').outerHeight();
let style = document.createElement('style');
style.type = 'text/css';
style.innerHTML = '.menu-open { height: '+ mobileNavHeight + 'px !important; transition-duration: 500ms;}';
document.getElementsByTagName('head')[0].appendChild(style);

            

 
//mobile nav toggle class
let menuButton= document.getElementById("menu");
menuButton.addEventListener("click", function(){toggle();});

function toggle(){
$('#mobileNav').toggleClass( "menu-open menu-close");
}
            
   
//set width of click areas
let pageWidth = $('body').width();  
$('.click-area').width((pageWidth-225)/2);



  
//set height of slideshow wrapper and re-calculate on window re-size
resizeHeight();
window.addEventListener("resize", function(){resizeHeight();});
       
function resizeHeight(){
    console.log("resizing height");
    let pageHeight = $('body').height();  
    $('#slideShowWrapper').height(pageHeight - 80);
}




//lift the 'curtain'
$(document).ready(
    setTimeout(function(){
        curtain = document.getElementById('slideShow');
        curtain.style.opacity ="1";
        console.log("hell?");
        }, 200));




//active link
var url = document.URL;
let links = document.getElementsByClassName('nav-link');
for(var i = 0; i < links.length; i++){
    if(links[i].href === url){
        links[i].style.color = "black";
    }
    
}   
            
//slideshow code
let pics = document.getElementsByClassName("slide");

for(let i = 0; i < pics.length; i++){
    pics[i].style.opacity = "0";
}

let current = 0;
pics[current].style.opacity="1"

function incrament(){
    pics[current].style.opacity ="0";
    (current === pics.length-1) ? current = 0 : current++;
    pics[current].style.opacity="1";
}

function deincrament(){
    pics[current].style.opacity ="0";
    (current === 0) ? current = pics.length - 1 : current--;
    pics[current].style.opacity="1";
}


let rightClick = document.getElementById("clickRight");
let leftClick = document.getElementById("clickLeft");
let prev = document.getElementById("prev");
let next = document.getElementById("next");
rightClick.addEventListener("click", function(){incrament()}, false);
leftClick.addEventListener("click", function(){deincrament()}, false);
next.addEventListener("click", function(){incrament()}, false);
prev.addEventListener("click", function(){deincrament()}, false);
