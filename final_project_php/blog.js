

function toggleLike(id) {
    // console.log(id);
    let likes = document.querySelector("#likes" + id);
    let likesNum = parseInt(likes.innerHTML.match(/\d+/)[0]);
    let userId = getCookie();
    console.log(userId);
    // console.log(likes);
    if (document.querySelector("#he" + id).classList.contains("hidden")) {
        $.ajax({
            url: "removelike.php",
            data: {pid: id, uid: userId},
            success: function(result){
              console.log(result);
              }
           });
           likes.innerHTML = (likesNum -1) + " like(s)";
    }

    else if (document.querySelector("#hf" + id).classList.contains("hidden")) {
        $.ajax({
            url: "insertlike.php",
            data: {pid: id, uid: userId},
            success: function(result){
              console.log(result);
              }
           });
        likes.innerHTML = (likesNum + 1) + " like(s)";
    }


    document.querySelector("#he" + id).classList.toggle("hidden");
    document.querySelector("#hf" + id).classList.toggle("hidden");
}



function deletePost (id) {
    console.log(id);
    const post = document.querySelector("#post" + id);
    post.parentNode.removeChild(post);

    //delete backend
    $.ajax({
        url: "deletePost.php",
        data: {pid: id},
        success: function(result){
          console.log(result);
          }
       });

}