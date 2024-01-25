window.addEventListener("scroll",function(){
    var header =document.querySelector(".profile");
    header.classList.toggle("sticky",window.scrollY > 0);
})
function toggle(){
var header =document.querySelector(".profile");
    header.classList.toggle("active" );
}
