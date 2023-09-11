function getCookie () {
    return parseInt(document.cookie.match(/\d+/)[0]);
}

function bodyClick () {
    console.log("body lcick");
    document.querySelector(".account-table").classList.add("hidden");
}

function accountTable ()   {
    console.log("acount");
    menu = true;
    document.querySelector(".account-table").classList.remove("hidden");
}
function logOut() {
    console.log("logout");
   
    document.cookie = "userid=0";
    $.ajax({
            url: "logOut.php",
            success: function(result){
                console.log(result);
            }
        });


    document.location.href = "default.php";

}