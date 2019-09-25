

var loginbtn = document.getElementById('loginbtn');
var login= document.getElementById('login');
var cancelbtn= document.getElementById('cancelbtn')


// Gdy kursor kliknie poza oknem
window.onclick = function(event) {
    if (event.target == login) {
        login.style.display = "none";
    }
}


//wydarzenia
loginbtn.addEventListener("click", function() { login.style.display='block' ; });
cancelbtn.addEventListener("click", function(){login.style.display = "none"; });
