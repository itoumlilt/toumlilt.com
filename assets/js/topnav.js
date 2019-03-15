/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function topnavFunction() {
    var x = document.getElementById("globalTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
    var y = document.getElementById("globalTopnavBgBlock");
    if (y.className === "topnav-bg-block") {
        y.className += " responsive";
    } else {
        y.className = "topnav-bg-block";
    }
}

