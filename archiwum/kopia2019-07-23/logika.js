

var loginbtn = document.getElementById('loginbtn');
var login= document.getElementById('login');


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == login) {
        login.style.display = "none";
    }
}

loginbtn.addEventListener("click", function() { login.style.display='block' ; });
